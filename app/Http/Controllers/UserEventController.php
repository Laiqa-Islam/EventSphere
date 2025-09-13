<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Support\Str;
use App\Models\Registration;
use Illuminate\Http\Request;
use App\Models\EventWaitlist;
use Illuminate\Support\Facades\Auth;
use App\Notifications\WaitlistPromotion;
use App\Notifications\RegistrationCancelled;
use App\Notifications\RegistrationConfirmed;

class UserEventController extends Controller
{
    public function index()
    {
        $now = now()->subDays(1);

        $upcomingEvents = Event::where('date', '>', $now)->where('status','approved')->orderBy('date')->get();
        $ongoingEvents = Event::where('date', '>=', $now)
            ->where('date', '<=', now()->addDays(1))->where('status','approved')
            ->orderBy('date')
            ->get();
        $pastEvents = Event::where('date', '<', $now)->where('status','approved')->orderByDesc('date')->get();

        return view('events.user_index', compact('upcomingEvents', 'ongoingEvents', 'pastEvents'));
    }

    public function show(Event $event)
    {
        $user = auth()->user();
        $isPastEvent = $event->date < (now()->subDays(1));

        // load feedback with user
        $feedback = $event->feedback()->with('student')->latest()->get();

        // check if logged in user actually attended this event
        $canGiveFeedback = false;
        if ($user) {
            $canGiveFeedback = $event->attendances()
                ->where('student_id', $user->id)
                ->where('attended', true)
                ->exists();
        }

        return view('events.user_show', compact('event', 'isPastEvent', 'feedback', 'canGiveFeedback'));
    }


    /**
     * Register for an event
     */
    public function register(Event $event, Request $request)
    {
        $user = Auth::user();

        // Prevent duplicate registrations
        if ($event->registrations()->where('student_id', $user->id)->where('status', 'confirmed')->exists()) {
            return back()->with('warning', 'You are already registered for this event.');
        }

        // Count confirmed registrations
        $confirmedCount = $event->registrations()->where('status', 'confirmed')->count();

        if ($confirmedCount < $event->max_participants) {
            // Register directly
            Registration::create([
                'event_id' => $event->id,
                'student_id' => $user->id,
                'status' => 'confirmed',
                'qr_token' => Str::uuid(),
            ]);
            $user->notify(new RegistrationConfirmed($event));
            return back()->with('success', 'You have successfully registered for the event! Check My Registrations page to get your QR Code');
        } else {
            // If full → join waitlist
            EventWaitlist::create([
                'event_id' => $event->id,
                'user_id' => $user->id,
            ]);

            return back()->with('info', 'This event is full. You have been added to the waitlist.');
        }
    }

    /**
     * Cancel registration or waitlist
     */
    public function cancel(Event $event)
{
    $user = Auth::user();

    // Find user's confirmed registration
    $registration = $event->registrations()
        ->where('student_id', $user->id)
        ->where('status', 'confirmed')
        ->first();

    if ($registration) {
        $registration->update(['status' => 'cancelled']);

        // Promote first user from waitlist
        $nextWaitlist = $event->waitlist()
            ->where('status', 'waiting')
            ->orderBy('waitlist_time', 'asc')
            ->first();

        if ($nextWaitlist) {
            $promotedUser = $nextWaitlist->user;

            // Create confirmed registration
            Registration::create([
                'event_id' => $event->id,
                'student_id' => $nextWaitlist->user_id,
                'status' => 'confirmed',
                'qr_token' => Str::uuid(),
            ]);

            // Update waitlist status
            $nextWaitlist->update(['status' => 'confirmed']);

            // Notify promoted user
            $promotedUser->notify(new WaitlistPromotion($event));
        }

        $user->notify(new RegistrationCancelled($event));

        return back()->with('info', 'Your registration has been cancelled.');
    }

    // If in waitlist → cancel that
    $waitlist = $event->waitlist()
        ->where('user_id', $user->id)
        ->where('status', 'waiting')
        ->first();

    if ($waitlist) {
        $waitlist->update(['status' => 'cancelled']);
        return back()->with('info', 'You have been removed from the waitlist.');
    }

    return back()->with('error', 'You are not registered or waitlisted for this event.');
}


    public function bookmark(Event $event)
    {
        auth()->user()->bookmarkedEvents()->syncWithoutDetaching([$event->id]);
        return redirect()->back()->with('success', 'Event bookmarked.');
    }

    public function unbookmark(Event $event)
    {
        auth()->user()->bookmarkedEvents()->detach($event->id);
        return redirect()->back()->with('success', 'Bookmark removed.');
    }

}

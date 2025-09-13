<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use App\Notifications\RegistrationStatusNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    /**
     * Student registers for an event.
     */
    public function store(Request $request, Event $event)
    {
        if (Auth::user()->role !== 'student') {
            return redirect()->back()->with('error', 'Only students can register for events.');
        }

        Registration::create([
            'event_id' => $event->id,
            'student_id' => Auth::id(),
        ]);

        return redirect()->route('events.show', $event->id)
            ->with('success', 'You have successfully registered!');
    }

    /**
     * Show logged-in student’s registrations
     */
    public function myRegistrations()
    {
        if (Auth::user()->role !== 'participant') {
            return redirect()->back()->with('error', 'Only students can view this.');
        }

        $registrations = Registration::with('event')
            ->where('student_id', Auth::id())
            ->latest('registered_on')
            ->paginate(10);

        return view('student.registrations.index', compact('registrations'));
    }

    /**
     * Student cancels their registration
     */
    public function cancel(Registration $registration)
    {
        if (Auth::id() !== $registration->student_id) {
            return redirect()->back()->with('error', 'Unauthorized.');
        }

        $registration->update(['status' => 'cancelled']);

        return redirect()->route('registrations.my')
            ->with('success', 'Your registration has been cancelled.');
    }


    /**
     * Organizer sees registrations for their event.
     */
    public function index(Event $event)
    {
        if (Auth::user()->role !== 'organizer') {
            return redirect()->back()->with('error', 'Unauthorized.');
        }

        $registrations = $event->registrations()->with('student')->get();

        return view('organizer.registrations.index', compact('event', 'registrations'));
    }

    /**
     * Organizer approves a registration.
     */
    public function approve(Registration $registration)
    {
        if (Auth::user()->role !== 'organizer') {
            return redirect()->back()->with('error', 'Unauthorized.');
        }

        $registration->update(['status' => 'confirmed']);
        $registration->student->notify(new RegistrationStatusNotification($registration->event, 'approved'));

        return back()->with('success', 'Registration approved.');
    }

    /**
     * Organizer rejects a registration.
     */
    public function reject(Registration $registration)
    {
        if (Auth::user()->role !== 'organizer') {
            return redirect()->back()->with('error', 'Unauthorized.');
        }

        $registration->update(['status' => 'cancelled']);
        $registration->student->notify(new RegistrationStatusNotification($registration->event, 'cancelled'));

        return back()->with('success', 'Registration rejected.');
    }
}

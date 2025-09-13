<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\EventAnnouncement;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::with('event')->latest()->paginate(10);
        return view('announcements.index', compact('announcements'));
    }

    public function create()
    {
        $events = Event::where('organizer_id', Auth::id())->get();

        $users = [];
        if (Auth::user()->role === 'admin') {
            $users = User::all();
        }

        return view('announcements.create', compact('events', 'users'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:150',
            'message' => 'required|string',
        ]);

        $announcement = Announcement::create([
            'event_id' => $request->event_id ?? null,
            'organizer_id' => $request->event_id ? Auth::id() : null,
            'admin_id' => !$request->event_id ? Auth::id() : null,
            'title' => $request->title,
            'message' => $request->message,
            'sent_at' => now(),
            'target_role' => $request->target_role ?? null,
            'target_users' => $request->target_users ? json_encode($request->target_users) : null,
        ]);

        // Decide recipients
        if ($request->event_id) {
            // Event announcement → participants
            $recipients = User::whereHas('registrations', function ($q) use ($request) {
                $q->where('event_id', $request->event_id);
            })->get();
        } elseif ($request->target_role) {
            $recipients = User::where('role', $request->target_role)->get();
        } elseif ($request->target_users) {
            $recipients = User::whereIn('id', $request->target_users)->get();
        } else {
            // System-wide (everyone)
            $recipients = User::all();
        }

        Notification::send($recipients, new EventAnnouncement($announcement));

        return redirect()->route('announcements.index')->with('success', 'Announcement sent successfully.');
    }

    public function fetchForUser()
    {
        $user = Auth::user();

        $announcements = Announcement::query()
            ->where(function ($q) use ($user) {
                $q->whereNull('target_role') // system-wide
                    ->orWhere('target_role', $user->role);
            })
            ->orWhereJsonContains('target_users', $user->id) // targeted to specific users
            ->latest()
            ->take(5)
            ->get();

        return $announcements;
    }

    public function all()
    {
        $user = Auth::user();

        $announcements = Announcement::query()
            ->where(function ($q) use ($user) {
                $q->whereNull('target_role')
                    ->orWhere('target_role', $user->role);
            })
            ->orWhereJsonContains('target_users', $user->id)
            ->latest()
            ->paginate(10);

        return view('announcements.all', compact('announcements'));
    }

    public function show(Announcement $announcement)
    {
        return view('announcements.show', compact('announcement'));
    }

    public function destroy(Announcement $announcement)
    {
        $announcement->delete();
        return redirect()->route('announcements.index')->with('success', 'Announcement deleted.');
    }
}

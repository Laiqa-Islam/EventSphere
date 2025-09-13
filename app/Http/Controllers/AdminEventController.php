<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\EventStatusNotification;

class AdminEventController extends Controller
{
    // List all pending events
    public function index()
    {
        $events = Event::where('status', 'pending')->get();
        return view('admin.events.index', compact('events'));
    }

    // Show details of one event
    public function show(Event $event)
    {
        return view('admin.events.show', compact('event'));
    }

    // Approve an event
    public function approve(Event $event)
    {
        $event->update(['status' => 'approved']);

        // Notify organizer
        Notification::send($event->organizer, new EventStatusNotification($event, 'approved'));

        return redirect()->route('admin.events.index')->with('success', 'Event approved successfully!');
    }

    // Reject an event
    public function reject(Event $event)
    {
        $event->update(['status' => 'rejected']);

        Notification::send($event->organizer, new EventStatusNotification($event, 'rejected'));

        return redirect()->route('admin.events.index')->with('error', 'Event rejected!');
    }

    // Request changes
    public function requestChanges(Request $request, Event $event)
    {
        $event->update(['status' => 'pending']); // stays pending but flagged
        Notification::send($event->organizer, new EventStatusNotification($event, 'changes_requested', $request->message));

        return redirect()->route('admin.events.index')->with('info', 'Requested changes from organizer.');
    }
}

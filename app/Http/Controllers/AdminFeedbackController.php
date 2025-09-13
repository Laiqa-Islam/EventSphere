<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Feedback;
use App\Mail\FeedbackDeletedMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Notifications\FeedbackDeleted;

class AdminFeedbackController extends Controller
{
    // Show all events with feedback counts
    public function index()
    {
        $events = Event::withCount('feedbacks')->get();
        return view('admin.feedback.index', compact('events'));
    }

    // Show feedback details for one event
    public function show($eventId)
    {
        $event = Event::with(['feedbacks.student'])->findOrFail($eventId);
        return view('admin.feedback.show', compact('event'));
    }

    // Delete feedback and notify student
    public function destroy($feedbackId)
    {
        $feedback = Feedback::with('student', 'event')->findOrFail($feedbackId);
        $student = $feedback->student;
        $event = $feedback->event;

        // delete feedback
        $feedback->delete();

        // send notification
        $student->notify(new FeedbackDeleted($event));

        return redirect()->back()->with('success', 'Feedback deleted and user notified.');
    }
}

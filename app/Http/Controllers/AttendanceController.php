<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;
use App\Models\Attendance;
use App\Models\Event;

class AttendanceController extends Controller
{
    public function scanner()
    {
        return view('events.scanner');
    }

    public function checkin(Request $request)
    {
        $code = $request->code; // e.g. "event_1_user_4"
        $parts = explode('_', $code);

        if (count($parts) !== 4) {
            return response()->json(['success' => false, 'message' => 'Invalid QR code format.']);
        }

        [$prefix1, $eventId, $prefix2, $userId] = $parts;

        // Validate registration
        $registration = Registration::where('event_id', $eventId)
            ->where('student_id', $userId)
            ->where('status', 'confirmed')
            ->first();

        if (!$registration) {
            return response()->json(['success' => false, 'message' => 'Invalid or unregistered participant.']);
        }

        // Mark attendance
        Attendance::updateOrCreate(
            ['event_id' => $eventId, 'student_id' => $userId],
            ['attended' => true]
        );

        return response()->json(['success' => true, 'message' => 'Attendance recorded successfully.']);
    }

    // Show list of events with number of attendees
    public function attendanceIndex()
    {
        $events = Event::withCount(['attendances' => function ($query) {
            $query->where('attended', true); // count only attended = true
        }])->get();

        return view('events.attendance_index', compact('events'));
    }

    // Show details of users who attended a specific event
    public function attendanceDetails($id)
    {
        $event = Event::with(['attendances.student'])->findOrFail($id);

        $attendees = $event->attendances->where('attended', true);

        return view('events.attendance_details', compact('event', 'attendees'));
    }

}

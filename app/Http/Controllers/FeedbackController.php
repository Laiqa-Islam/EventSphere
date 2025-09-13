<?php
namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function store(Request $request, $eventId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comments' => 'nullable|string|max:1000',
        ]);

        Feedback::create([
            'event_id' => $eventId,
            'student_id' => auth()->id(),
            'rating' => $request->rating,
            'comments' => $request->comments,
        ]);

        return redirect()->back()->with('success', 'Your feedback has been submitted!');
    }
}

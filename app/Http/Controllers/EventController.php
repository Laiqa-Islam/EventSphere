<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Venue;
use App\Models\MediaGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of events.
     */
    public function index()
    {
        $events = Event::with('venue', 'organizer')->latest()->paginate(10);
        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new event.
     */
    public function create()
    {
        if (Auth::user()->role !== 'organizer' && Auth::user()->role !== 'admin') {
            return redirect()->route('events.index')->with('error', 'Unauthorized.');
        }

        $venues = Venue::all();
        return view('events.create', compact('venues'));
    }

    /**
     * Store a newly created event in storage.
     */
    public function store(Request $request)
    {
        if (Auth::user()->role !== 'organizer' && Auth::user()->role !== 'admin') {
            return redirect()->route('events.index')->with('error', 'Unauthorized.');
        }

        $request->validate([
            'title' => 'required|string|max:150',
            'description' => 'required|string',
            'category' => 'required|string|max:50',
            'date' => 'required|date',
            'time' => 'required',
            'venue_id' => 'nullable|exists:venues,id',
            'banner' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'max_participants' => 'nullable|integer|min:1',
        ]);

        $bannerPath = null;
        if ($request->hasFile('banner')) {
            $bannerPath = $request->file('banner')->store('banners', 'public');
        }

        Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'date' => $request->date,
            'time' => $request->time,
            'venue_id' => $request->venue_id,
            'organizer_id' => Auth::id(),
            'status' => 'pending',
            'banner_image' => $bannerPath,
            'max_participants' => $request->max_participants,
            'rulebook' => $request->hasFile('rulebook') ? $request->file('rulebook')->store('rulebooks', 'public') : null,
        ]);

        return redirect()->route('events.index')->with('success', 'Event created successfully!');
    }


    public function show(Request $request, Event $event){
        $mediaGalleries = MediaGallery::where('event_id', $event->id)->get();
        return view('events.show', compact('event', 'mediaGalleries'));
    }

    /**
     * Show the form for editing the specified event.
     */
    public function edit(Event $event)
    {
        if (Auth::id() !== $event->organizer_id && Auth::user()->role !== 'admin') {
            return redirect()->route('events.index')->with('error', 'Unauthorized.');
        }

        $venues = Venue::all();
        return view('events.edit', compact('event', 'venues'));
    }

    /**
     * Update the specified event in storage.
     */
    public function update(Request $request, Event $event)
    {
        if (Auth::id() !== $event->organizer_id && Auth::user()->role !== 'admin') {
            return redirect()->route('events.index')->with('error', 'Unauthorized.');
        }

        $request->validate([
            'title' => 'required|string|max:150',
            'description' => 'required|string',
            'category' => 'required|string|max:50',
            'date' => 'required|date',
            'time' => 'required',
            'venue_id' => 'nullable|exists:venues,id',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'max_participants' => 'nullable|integer|min:1',
            'rulebook' => 'nullable|mimes:pdf|max:2048',
        ]);

        if ($request->hasFile('banner')) {
            $bannerPath = $request->file('banner')->store('banners', 'public');
            $event->banner_image = $bannerPath;
        }

        $event->update($request->except(['banner']) + ['banner' => $event->banner]);

        return redirect()->route('events.index')->with('success', 'Event updated successfully!');
    }

    /**
     * Remove the specified event from storage.
     */
    public function destroy(Event $event)
    {
        if (Auth::id() !== $event->organizer_id && Auth::user()->role !== 'admin') {
            return redirect()->route('events.index')->with('error', 'Unauthorized.');
        }

        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully!');
    }
}

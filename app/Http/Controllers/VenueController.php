<?php

namespace App\Http\Controllers;

use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VenueController extends Controller
{
    /**
     * Display a listing of venues.
     */
    public function index()
    {
        $venues = Venue::latest()->paginate(10);
        return view('venues.index', compact('venues'));
    }

    /**
     * Show the form for creating a new venue.
     */
    public function create()
    {
        if (Auth::user()->role !== 'organizer' && Auth::user()->role !== 'admin') {
            return redirect()->route('venues.index')->with('error', 'Unauthorized.');
        }

        return view('venues.create');
    }

    /**
     * Store a newly created venue in storage.
     */
    public function store(Request $request)
    {
        if (Auth::user()->role !== 'organizer' && Auth::user()->role !== 'admin') {
            return redirect()->route('venues.index')->with('error', 'Unauthorized.');
        }

        $request->validate([
            'name' => 'required|string|max:100',
            'location' => 'nullable|string|max:150',
            'capacity' => 'required|integer|min:0',
        ]);

        Venue::create($request->only(['name', 'location', 'capacity']));

        return redirect()->route('venues.index')->with('success', 'Venue created successfully!');
    }

    /**
     * Show the form for editing the specified venue.
     */
    public function edit(Venue $venue)
    {
        if (Auth::user()->role !== 'organizer' && Auth::user()->role !== 'admin') {
            return redirect()->route('venues.index')->with('error', 'Unauthorized.');
        }

        return view('venues.edit', compact('venue'));
    }

    /**
     * Update the specified venue in storage.
     */
    public function update(Request $request, Venue $venue)
    {
        if (Auth::user()->role !== 'organizer' && Auth::user()->role !== 'admin') {
            return redirect()->route('venues.index')->with('error', 'Unauthorized.');
        }

        $request->validate([
            'name' => 'required|string|max:100',
            'location' => 'nullable|string|max:150',
            'capacity' => 'required|integer|min:0',
        ]);

        $venue->update($request->only(['name', 'location', 'capacity']));

        return redirect()->route('venues.index')->with('success', 'Venue updated successfully!');
    }

    /**
     * Remove the specified venue from storage.
     */
    public function destroy(Venue $venue)
    {
        if (Auth::user()->role !== 'organizer' && Auth::user()->role !== 'admin') {
            return redirect()->route('venues.index')->with('error', 'Unauthorized.');
        }

        $venue->delete();

        return redirect()->route('venues.index')->with('success', 'Venue deleted successfully!');
    }
}

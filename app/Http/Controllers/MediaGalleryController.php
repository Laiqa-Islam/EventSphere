<?php

namespace App\Http\Controllers;

use App\Models\MediaGallery;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MediaGalleryController extends Controller
{
    public function index()
    {
        $media = MediaGallery::with(['event', 'uploader'])->latest()->paginate(10);
        return view('media_gallery.index', compact('media'));
    }

    public function create()
    {
        $events = Event::where('organizer_id', Auth::id())->get();
        return view('media_gallery.create', compact('events'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_id'   => 'required|exists:events,id',
            'file_type'  => 'required|in:image,video',
            'file'       => 'required|file|mimes:jpg,jpeg,png,mp4,mov|max:20480',
            'caption'    => 'nullable|string|max:150',
        ]);

        $path = $request->file('file')->store('media_gallery', 'public');

        MediaGallery::create([
            'event_id'   => $request->event_id,
            'file_type'  => $request->file_type,
            'file_url'   => $path,
            'uploaded_by'=> Auth::id(),
            'caption'    => $request->caption,
        ]);

        return redirect()->route('media-gallery.index')->with('success', 'Media uploaded successfully.');
    }

    public function show(MediaGallery $mediaGallery)
    {
        return view('media_gallery.show', compact('mediaGallery'));
    }

    public function edit(MediaGallery $mediaGallery)
    {
        $events = Event::where('organizer_id', Auth::id())->get();
        return view('media_gallery.edit', compact('mediaGallery', 'events'));
    }

    public function update(Request $request, MediaGallery $mediaGallery)
    {
        $request->validate([
            'event_id'   => 'required|exists:events,id',
            'file_type'  => 'required|in:image,video',
            'caption'    => 'nullable|string|max:150',
        ]);

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($mediaGallery->file_url);
            $path = $request->file('file')->store('media_gallery', 'public');
            $mediaGallery->file_url = $path;
        }

        $mediaGallery->update([
            'event_id'   => $request->event_id,
            'file_type'  => $request->file_type,
            'caption'    => $request->caption,
        ]);

        return redirect()->route('media-gallery.index')->with('success', 'Media updated successfully.');
    }

    public function destroy(MediaGallery $mediaGallery)
    {
        Storage::disk('public')->delete($mediaGallery->file_url);
        $mediaGallery->delete();

        return redirect()->route('media-gallery.index')->with('success', 'Media deleted successfully.');
    }
}

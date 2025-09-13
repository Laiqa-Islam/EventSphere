<?php

namespace App\Http\Controllers;

use App\Models\MediaGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserGalleryController extends Controller
{
    // Show all media
    public function index()
    {
        $media = MediaGallery::with('event')->latest()->paginate(12);
        return view('media_gallery.user_index', compact('media'));
    }

    // Show single media with event details
    public function show($id)
    {
        $media = MediaGallery::with('event.venue', 'event.organizer')->findOrFail($id);
        return view('media_gallery.user_show', compact('media'));
    }

    // Save/remove favorite
    public function toggleFavorite($id)
    {
        $user = Auth::user();
        if ($user->favorites()->where('media_gallery_id', $id)->exists()) {
            $user->favorites()->detach($id);
            return back()->with('success', 'Removed from favorites.');
        } else {
            $user->favorites()->attach($id);
            return back()->with('success', 'Added to favorites.');
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\MediaGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritesController extends Controller
{
    // Toggle favorite
    public function toggle($mediaId)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You need to log in to favorite.');
        }

        $user = Auth::user();
        $media = MediaGallery::findOrFail($mediaId);

        if ($user->favorites()->where('media_gallery_id', $mediaId)->exists()) {
            // Already favorited → remove
            $user->favorites()->detach($mediaId);
            return back()->with('success', 'Removed from favorites.');
        } else {
            // Not yet favorited → add
            $user->favorites()->attach($mediaId);
            return back()->with('success', 'Added to favorites!');
        }
    }

    // Show user's favorites
    public function myFavorites()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You need to log in to view favorites.');
        }

        $favorites = Auth::user()->favorites()->get();

        return view('student.favorites.index', compact('favorites'));
    }
}

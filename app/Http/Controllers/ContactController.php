<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // Validate inputs
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Save to database
        Contact::create($request->only('name', 'email', 'message'));

        // Redirect back with success message
        return back()->with('success', 'Your message has been sent successfully!');
    }
}

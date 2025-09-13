<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredOrganizerController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.organizer.register2');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'         => ['required', 'string', 'max:255'],
            'email'        => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password'     => ['required', 'confirmed', Rules\Password::defaults()],
            'full_name'    => ['required', 'string', 'max:100'],
            'mobile'       => ['nullable', 'string', 'max:15'],
            'department'   => ['nullable', 'string', 'max:100'],
            'enrollment_no'=> ['nullable', 'string', 'max:50'],
            'role'         => ['in:participant,organizer,admin'], // default handled by DB
        ]);

        $user = User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'full_name'     => $request->full_name,
            'mobile'        => $request->mobile,
            'department'    => $request->department,
            'enrollment_no' => $request->enrollment_no,
            'role'          => 'organizer', // fallback
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('organizer.dashboard');
    }
}

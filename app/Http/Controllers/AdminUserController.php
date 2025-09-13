<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Notifications\UserSuspendedNotification;
use App\Notifications\UserRoleChangedNotification;
use App\Notifications\PasswordResetByAdminNotification;
use Illuminate\Support\Facades\Notification;

class AdminUserController extends Controller
{
    // List all users
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // Show user profile
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    // Update role
    public function updateRole(Request $request, User $user)
    {
        $request->validate(['role' => 'required|in:participant,organizer,admin']);
        $user->update(['role' => $request->role]);
        $user->notify(new UserRoleChangedNotification($request->role));
        return redirect()->route('admin.users.index')->with('success', 'Role updated successfully!');
    }

    // Reset password
    public function resetPassword(User $user)
    {
        $newPassword = 'Password123'; // Or generate random
        $user->update(['password' => Hash::make($newPassword)]);

        Notification::send($user, new PasswordResetByAdminNotification($newPassword));
        return redirect()->route('admin.users.show', $user->id)
            ->with('success', "Password reset. New password: {$newPassword}");
    }

    // Suspend / Unsuspend
    public function suspend(User $user)
    {
        $user->update(['is_suspended' => !$user->is_suspended]);
        $status = $user->is_suspended ? 'suspended' : 'unsuspended';

        $user->notify(new UserSuspendedNotification($user->is_suspended));
        return redirect()->route('admin.users.index')->with('info', "User has been {$status}.");
    }

    // Delete inactive user
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('error', 'User deleted.');
    }
}

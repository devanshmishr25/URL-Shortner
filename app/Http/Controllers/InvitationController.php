<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class InvitationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function send(Request $request)
    {
        $user = Auth::user();

        // SuperAdmin cannot invite
        if ($user->isSuperAdmin()) {
            return back()->withErrors(['error' => 'SuperAdmin cannot invite users.']);
        }

        // Admin can only invite Members
        if ($user->isAdmin()) {
            $validated = $request->validate([
                'email' => 'required|email|unique:users',
                'role' => 'required|in:Member',
            ]);
        } else {
            return back()->withErrors(['error' => 'Only Admins can invite users.']);
        }

        Invitation::create([
            'company_id' => $user->company_id,
            'email' => $validated['email'],
            'role' => $validated['role'],
            'invited_by' => $user->id,
        ]);

        return back()->with('success', 'Invitation sent successfully.');
    }

    public function accept($token)
    {
        $invitation = Invitation::where('id', $token)->firstOrFail();

        if ($invitation->isAccepted()) {
            return redirect()->route('login')->with('error', 'This invitation has already been accepted.');
        }

        $invitation->update(['accepted_at' => now()]);

        return redirect()->route('register.accept', ['email' => $invitation->email, 'company_id' => $invitation->company_id, 'role' => $invitation->role]);
    }

    public function registerAccept(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $request->email,
            'password' => Hash::make($validated['password']),
            'company_id' => $request->company_id,
            'role' => $request->role,
        ]);

        Auth::login($user);
        return redirect()->route('dashboard');
    }
}

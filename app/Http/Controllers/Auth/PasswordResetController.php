<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    /**
     * Show the password reset request form.
     */
    public function showResetRequestForm()
    {
        return view('auth.passwords.email');
    }

    /**
     * Send password reset link.
     */
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();
        
        if (!$user) {
            return back()->withErrors(['email' => 'Email address not found.']);
        }

        // Generate a reset token and save it
        $token = Str::random(60);
        
        // For simplicity, store in session/database. In production, use proper email verification
        // Here we'll create a temporary reset token in memory
        session(['password_reset_' . $user->id => $token]);

        // In a production app, you'd send an email with the reset link
        // For now, we'll show the reset form with token

        return redirect()->route('password.reset', ['token' => $token, 'email' => $user->email])
            ->with('success', 'Please reset your password.');
    }

    /**
     * Show the password reset form.
     */
    public function showResetForm($token)
    {
        return view('auth.passwords.reset', ['token' => $token]);
    }

    /**
     * Reset the user's password.
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => ['required', 'confirmed', 'min:8'],
            'password_confirmation' => ['required'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email address not found.']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login')->with('success', 'Password has been reset successfully. Please log in.');
    }
}

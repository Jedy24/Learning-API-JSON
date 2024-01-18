<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function showChangePasswordForm()
    {
        return view('change-password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'password:' . auth()->user()->password],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'current_password.password' => 'The current password is incorrect.',
            'new_password.confirmed' => 'The new password confirmation does not match.',
        ]);

        $user = auth()->user();

        $user->update(['password' => Hash::make($request->new_password)]);

        return redirect()->route('change-password')->with('success', 'Password has been changed successfully.');
    }
}

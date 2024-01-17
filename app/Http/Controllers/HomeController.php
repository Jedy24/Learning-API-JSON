<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function indexJson(Request $request)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            $user = Auth::user();

            // Return user data in JSON format
            return response()->json([
                'name' => $user->name,
                'email' => $user->email,
                'provider' => $this->getAuthProvider($user),
            ]);
        } else {
            return response()->json(['message' => 'User not authenticated.']);
        }
    }

    private function getAuthProvider($user)
    {
        // Determine the authentication provider based on user attributes
        if ($user->google_id) {
            return 'google';
        } elseif ($user->facebook_id) {
            return 'facebook';
        }

        return 'unknown';
    }
}

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
        // Cek user authenticated
        if (Auth::check()) {
            $user = Auth::user();

            // Mengembalikan data user dalam JSON response
            return response()->json([
                'name' => $user->name,
                'email' => $user->email,
                'password' => $user->password,
                'provider' => $this->getAuthProvider($user),
            ]);
        } else {
            return response()->json(['message' => 'User not authenticated.']);
        }
    }

    private function getAuthProvider($user)
    {
        // Mengembalikan data provider sesuai cara login
        if ($user->google_id) {
            return 'google';
        } elseif ($user->facebook_id) {
            return 'facebook';
        }

        return 'unknown';
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;

class GitHubController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function callback()
    {
        $userFromGitHub = Socialite::driver('github')->user();

        $userFromDatabase = User::where('github_id', $userFromGitHub->getId())->first();

        if (!$userFromDatabase) {
            $newUser = new User([
                'name' => $userFromGitHub->getName(),
                'email' => $userFromGitHub->getEmail(),
                'github_id' => $userFromGitHub->getId(),
                'password' => Hash::make('123456789'),
            ]);

            $newUser->save();

            auth('web')->login($newUser);
            session()->regenerate();

            return redirect('/');
        }

        auth('web')->login($userFromDatabase);
        session()->regenerate();

        return redirect('/');
    }

    public function logout(Request $request)
    {
        auth('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}

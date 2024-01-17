<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback()
    {
        $userFromFacebook = Socialite::driver('facebook')->user();

        $userFromDatabase = User::where('facebook_id', $userFromFacebook->getId())->first();

        if (!$userFromDatabase) {
            $newUser = new User([
                'name' => $userFromFacebook->getName(),
                'email' => $userFromFacebook->getEmail(),
                'facebook_id' => $userFromFacebook->getId(),
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

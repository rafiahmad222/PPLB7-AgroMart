<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash as Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect(){
        return Socialite::driver('google')->redirect();
    }

    public function callback(){

        $googleUser = Socialite::driver('google')->user();

        $registeredUser = User::where('google_id', $googleUser->id)->first();
        if (!$registeredUser)
        {

            $user = User::updateOrCreate([
                'google_id' => $googleUser->id,
            ], [
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'password' => Hash::make('password_google'),
                'role' => 'user',
                'google_token' => $googleUser->token,
                'google_refresh_token' => $googleUser->refreshToken,
            ]);

            Auth::login($user);

            return $this->redirectUser();
        }

        Auth::login($registeredUser);

        return $this->redirectUser();
    }

    private function redirectUser()
    {
        if (Auth::user()->role == 'admin') {
            return redirect('/home');
        } else {
            return redirect('/home');
        }
    }
}

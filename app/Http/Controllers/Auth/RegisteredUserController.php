<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    /**
     * Show the registration view.
     */
    public function create()
    {
        return view('auth.register'); // ini menampilkan form dari view yang sudah kamu kirim
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:8'],
            'address'  => ['required', 'string', 'max:255'],
            'phone'    => ['required', 'string', 'max:20'],
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'address'  => $request->address,
            'phone'    => $request->phone,
            'role'     => 'user',
            'avatar_url' => 'avatar.png',
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('home'); 
    }
}

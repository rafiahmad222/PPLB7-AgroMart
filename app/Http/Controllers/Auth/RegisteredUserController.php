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
            'phone'    => ['required', 'string', 'max:13','min:12', 'regex:/^[0-9]+$/'],
        ],[
            'name.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
            'phone.required' => 'Nomor telepon tidak boleh kosong',
            'password.min' => 'Password minimal 8 karakter',
            'phone.regex' => 'Nomor telepon hanya boleh mengandung angka',
            'address.min' => 'Alamat minimal 10 karakter',
            'phone.min' => 'Nomor telepon minimal 12 karakter',
            'email.unique' => 'Email anda sudah terdaftar',
            'email.email' => 'Format email tidak sesuai',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'phone'    => $request->phone,
            'role'     => 'user',
            'avatar_url' => 'avatar.png',
        ]);

        event(new Registered($user));

        Auth::login($user);
        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Registrasi berhasil!']);
        }

        return redirect()->route('home')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}

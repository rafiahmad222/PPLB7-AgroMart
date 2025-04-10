<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi data input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'avatar_url' => ['nullable', 'string', 'max:255'], // Opsional
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:15', 'regex:/^[0-9]+$/'], // Validasi nomor HP hanya angka
            'role' => ['nullable', 'string', 'in:user,admin'], // Default: user
            'google_id' => ['nullable', 'string', 'max:255'], // Opsional
            'google_token' => ['nullable', 'string', 'max:255'], // Opsional
            'google_refresh_token' => ['nullable', 'string', 'max:255'], // Opsional
        ]);

    // Buat pengguna baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'avatar_url' => $request->avatar_url ?? 'default-avatar.png', // Nilai default jika tidak diisi
            'password' => Hash::make($request->password), // Hash password sebelum disimpan
            'address' => $request->address,
            'phone' => $request->phone,
            'role' => $request->role ?? 'user', // Default role
            'google_id' => $request->google_id,
            'google_token' => $request->google_token,
            'google_refresh_token' => $request->google_refresh_token,
        ]);

        // Trigger event Registered
        event(new Registered($user));

        // Login pengguna setelah registrasi
        Auth::login($user);

        // Redirect ke halaman home atau dashboard
        return redirect()->route('home')->with('status', 'Akun berhasil dibuat!');
    }
}

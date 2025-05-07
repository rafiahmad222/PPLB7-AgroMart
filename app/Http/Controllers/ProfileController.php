<?php

namespace App\Http\Controllers;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use App\Models\Alamat;
use App\Models\Kategori;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $kategoris = Kategori::all();
        $alamat = Alamat::with(['kabupatenKota', 'kecamatan', 'kodePos'])
            ->where('user_id', Auth::user()->id)->get();
        return view('profile.edit', [
            'user' => $request->user(),
            'kategoris' => $kategoris,
            'alamat' => $alamat,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $request->user()->id],
            'phone' => ['nullable', 'string', 'max:15'],
            'cropped_avatar' => ['nullable', 'string'],
        ]);

        $user = $request->user();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        if ($request->filled('cropped_avatar')) {
            $avatarData = $request->input('cropped_avatar');
            $avatarPath = 'avatars/' . uniqid() . '.png';

            Storage::disk('public')->put(
                $avatarPath,
                base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $avatarData))
            );

            $user->avatar_url = '/storage/' . $avatarPath;
        }

        $user->save();

        return redirect()->route('profile.edit')->with('status', 'Profil berhasil diperbarui.');
    }
}


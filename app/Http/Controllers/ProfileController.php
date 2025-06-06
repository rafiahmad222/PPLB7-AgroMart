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
use App\Models\KabupatenKota;
use App\Models\Kecamatan;
use App\Models\KodePos;

class ProfileController extends Controller
{
    public function getKecamatan($id_kabupaten_kota)
    {
        $kecamatan = Kecamatan::where('id_kabupaten_kota', $id_kabupaten_kota)->get();
        return response()->json($kecamatan);
    }

    public function getKodePos($id_kecamatan)
    {
        $kodePos = KodePos::where('id_kecamatan', $id_kecamatan)->get();
        return response()->json($kodePos);
    }
    public function edit(Request $request): View
    {
        $kabupatenKota = KabupatenKota::all();
        $kecamatan = Kecamatan::all();
        $kodePos = KodePos::all();
        $kategoris = Kategori::all();
        $alamat = Alamat::with(['kabupatenKota', 'kecamatan', 'kodePos'])
            ->where('user_id', Auth::user()->id)->get();
        return view('profile.edit', [
            'user' => $request->user(),
            'kategoris' => $kategoris,
            'kabupatenKota' => $kabupatenKota,
            'kecamatan' => $kecamatan,
            'kodePos' => $kodePos,
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
            'phone' => ['required', 'string', 'max:13', 'min:12', 'regex:/^[0-9]+$/'],
            'cropped_avatar' => ['nullable', 'string'],
        ],[
            'name.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'phone.required' => 'Nomor telepon tidak boleh kosong',
            'phone.regex' => 'Nomor telepon hanya boleh mengandung angka',
            'address.min' => 'Alamat minimal 10 karakter',
            'phone.min' => 'Nomor telepon minimal 12 karakter',
            'email.unique' => 'Email anda sudah terdaftar',
            'email.email' => 'Format email tidak sesuai',
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

        return redirect()->route('profile.edit')->with('success', 'profile_updated');;
    }
}

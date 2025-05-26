<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kecamatan;
use App\Models\KodePos;
use App\Models\Alamat;
use App\Models\KabupatenKota;
use Illuminate\Support\Facades\Auth;

class AlamatController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'label_alamat' => 'required|string|max:255',
            'detail_alamat' => 'required|string',
            'id_kabupaten_kota' => 'required|exists:kabupaten_kota,id_kabupaten_kota',
            'id_kecamatan' => 'required|exists:kecamatan,id_kecamatan',
            'id_kode_pos' => 'required|exists:kode_pos,id_kode_pos',
            'nama_jalan' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);
        Alamat::create([
            'user_id' => Auth::id(),
            'label_alamat' => $request->label_alamat,
            'detail_alamat' => $request->detail_alamat,
            'id_kabupaten_kota' => $request->id_kabupaten_kota,
            'id_kecamatan' => $request->id_kecamatan,
            'id_kode_pos' => $request->id_kode_pos,
            'nama_jalan' => $request->nama_jalan,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return redirect()->route('profile.edit')->with('status', 'Alamat berhasil ditambahkan!');
    }

    public function update(Request $request)
    {
        $request->validate([
            'label_alamat' => 'required|string|max:255',
            'detail_alamat' => 'required|string',
            'id_kabupaten_kota' => 'required|exists:kabupaten_kota,id_kabupaten_kota',
            'id_kecamatan' => 'required|exists:kecamatan,id_kecamatan',
            'id_kode_pos' => 'required|exists:kode_pos,id_kode_pos',
        ]);

        $alamat = Alamat::findOrFail($request->id_alamat);
        $alamat->update([
            'label_alamat' => $request->label_alamat,
            'detail_alamat' => $request->detail_alamat,
            'id_kabupaten_kota' => $request->id_kabupaten_kota,
            'id_kecamatan' => $request->id_kecamatan,
            'id_kode_pos' => $request->id_kode_pos,
        ]);

        return redirect()->route('profile.edit')->with('status', 'Alamat berhasil diperbarui!');
    }
}

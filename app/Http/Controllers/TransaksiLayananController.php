<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Layanan;
use App\Models\Alamat;
use App\Models\TransaksiLayanan;
use Illuminate\Support\Facades\Auth;

class TransaksiLayananController extends Controller
{
    public function create(Request $request)
    {
        $layanans = Layanan::all();
        $alamat = Alamat::where('user_id', Auth::id())->get();
        $layananTerpilih = $request->query('layanan_id');

        return view('transaksi-layanan.create', compact('layanans', 'alamat', 'layananTerpilih'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'layanan_id' => 'required|exists:layanans,id_layanan',
            'alamat_id' => 'required|exists:alamat,id_alamat',
            'jumlah' => 'required|integer|min:1',
            'jadwal_booking' => 'required|date',
            'pembayaran' => 'required|in:transfer,cod',
            'bukti_transfer' => 'nullable|image|max:2048',
        ]);

        $layanan = Layanan::find($data['layanan_id']);
        $total = $layanan->harga * $data['jumlah'];

        $bukti = null;
        if ($data['pembayaran'] == 'transfer' && $request->hasFile('bukti_transfer')) {
            $bukti = $request->file('bukti_transfer')->store('bukti_transfer', 'public');
        }

        TransaksiLayanan::create([
            'user_id' => Auth::id(),
            'layanan_id' => $data['layanan_id'],
            'alamat_id' => $data['alamat_id'],
            'jumlah' => $data['jumlah'],
            'jadwal_booking' => $data['jadwal_booking'],
            'pembayaran' => $data['pembayaran'],
            'bukti_transfer' => $bukti,
            'total' => $total,
            'status' => 'pending',
        ]);

        return redirect()->route('layanan.show', $data['layanan_id'])->with('success', 'Transaksi berhasil!');
    }
}

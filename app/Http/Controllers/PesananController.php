<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Produk;

class PesananController extends Controller
{
    public function pesananku(Request $request)
    {
        $kategoris = Kategori::all();
        $user = Auth::user();
        $query = Pesanan::with(['produk', 'alamat.kecamatan', 'alamat.kabupatenKota', 'alamat.kodePos'])
            ->where('user_id', $user->id);

        // Menerapkan filter status jika parameter status diberikan
        if ($request->has('status')) {
            $status = $request->get('status');
            $query->where('status', $status);
        }

        $pesanans = $query->orderBy('created_at', 'desc')->paginate(9);
        return view('pesanan.pesananku', compact('kategoris', 'pesanans'));
    }

    public function konfirmasi($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        if ($pesanan->status == 'Diterima') {
            $pesanan->status = 'Selesai';
            $pesanan->save();
            return redirect()->route('pesananku')->with('success', 'Pesanan berhasil dikonfirmasi.');
        } else {
            return redirect()->route('pesananku')->with('error', 'Pesanan tidak dapat dikonfirmasi.');
        }
    }
}

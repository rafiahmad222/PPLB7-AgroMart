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
    public function pesananku()
    {
        $kategoris = Kategori::all();
        $user = Auth::user();
        $pesanans = Pesanan::where('nama', $user->name)->get();

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

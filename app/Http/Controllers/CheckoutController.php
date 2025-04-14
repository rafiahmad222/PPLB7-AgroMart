<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class CheckoutController extends Controller
{
public function index(Request $request)
{
    $produk = Produk::findOrFail($request->input('produk_id'));
    $jumlah = $request->input('jumlah', 1); // Default ke 1 jika tidak ada input
    $totalHarga = $produk->harga_produk * $jumlah;

    return view('checkout.index', [
        'produk' => $produk,
        'jumlah' => $jumlah,
        'totalHarga' => $totalHarga,
    ]);
}

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'pengiriman' => 'required',
            'pembayaran' => 'required',
            'jumlah' => 'required|integer|min:1',
        ]);

        $produk = Produk::findOrFail($request->produk_id);
        $totalHarga = $produk->harga_produk * $request->jumlah;
        $totalPembayaran = $totalHarga + $request->ongkir;

        $pesanan = Pesanan::create([
            'produk_id'   => $produk->id_produk,
            'jumlah'      => $request->jumlah,
            'nama'        => Auth::user()->name,
            'alamat'      => $request->alamat,
            'no_hp'       => $request->no_hp,
            'pengiriman'  => $request->pengiriman,
            'jarak'       => $request->pengiriman == 'wa_jek' ? $request->jarak : null,
            'ongkir'      => $request->ongkir,
            'pembayaran'  => $request->pembayaran,
            'total'       => $totalPembayaran,
            'status'      => 'Diproses', // default status awal
        ]);

        return redirect()->route('checkout.invoice', $pesanan->id_pesanan)
            ->with('success', 'Pesanan berhasil dibuat. Silakan cek invoice.');
    }

    public function invoice($id)
    {
        $pesanan = Pesanan::with('produk')->findOrFail($id);
        return view('checkout.invoice', compact('pesanan'));
    }
}

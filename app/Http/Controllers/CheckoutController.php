<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;
use App\Models\Alamat;
use App\Models\User;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $produk = Produk::findOrFail($request->input('produk_id'));
        $jumlah = $request->input('jumlah', 1); // Default ke 1 jika tidak ada input
        $totalHarga = $produk->harga_produk * $jumlah;
        $ongkir = 0;
        $totalPembayaran = $totalHarga + $ongkir; // Default ongkir ke 0 jika tidak ada input
        $alamat = Alamat::where('user_id', Auth::id())->get();
        return view('checkout.index', [
            'produk' => $produk,
            'jumlah' => $jumlah,
            'totalHarga' => $totalHarga,
            'totalPembayaran' => $totalPembayaran,
            'alamat' => $alamat,
        ]);
    }

    public function store(Request $request)
    {
        $validationRules = [
            'alamat_id' => 'required|exists:alamat,id_alamat',
            'produk_id' => 'required|exists:produks,id_produk',
            'jumlah' => 'required|integer|min:1',
            'pembayaran' => 'required|in:Transfer,COD',
            'pengiriman' => 'required|in:Paxel,Ambil Ditempat',
        ];

        // Add validation rule for bukti_pembayaran if payment method is transfer
        if ($request->pembayaran === 'transfer') {
            $validationRules['bukti_pembayaran'] = 'required|image|mimes:jpeg,png,jpg|max:2048';
        }

        $request->validate($validationRules);

        $produk = Produk::findOrFail($request->produk_id);
        $totalHarga = $produk->harga_produk * $request->jumlah;
        $totalPembayaran = $totalHarga + $request->ongkir;

        // Handle file upload if exists
        $buktiPembayaranPath = null;
        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $buktiPembayaranPath = $file->storeAs('bukti_pembayaran', $fileName, 'public');
        }

        $pesanan = Pesanan::create([
            'user_id' => Auth::id(),
            'alamat_id' => $request->alamat_id,
            'produk_id' => $produk->id_produk,
            'pengiriman' => $request->pengiriman,
            'ongkir' => $request->ongkir,
            'jumlah' => $request->jumlah,
            'pembayaran' => $request->pembayaran,
            'bukti_pembayaran' => $buktiPembayaranPath, // Save file path
            'total' => $totalPembayaran,
            'status' => 'Diproses',
        ]);

        // Update stok produk
        $produk->jumlah_stok -= $request->jumlah;
        $produk->save();

        return redirect()->route('checkout.invoice', $pesanan->id_pesanan)
            ->with('success', 'Pesanan berhasil dibuat. Silakan cek invoice.');
    }

    public function invoice($id)
    {
        $pesanan = Pesanan::with(['produk', 'alamat.kabupatenKota', 'alamat.kecamatan', 'alamat.kodePos', 'user'])->findOrFail($id);
        return view('checkout.invoice', compact('pesanan'));
    }
}

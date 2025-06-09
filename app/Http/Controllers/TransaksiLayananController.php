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
            'pembayaran' => 'required|in:Transfer,COD',
            'bukti_transfer' => 'nullable|image|max:2048',
        ]);

        $layanan = Layanan::find($data['layanan_id']);
        $total = $layanan->harga_layanan * $data['jumlah'];

        $bukti = null;
        if ($data['pembayaran'] == 'transfer' && $request->hasFile('bukti_transfer')) {
            $bukti = $request->file('bukti_transfer')->store('bukti_transfer', 'public');
        }

        $transaksi = TransaksiLayanan::create([
            'user_id' => Auth::id(),
            'layanan_id' => $data['layanan_id'],
            'alamat_id' => $data['alamat_id'],
            'jumlah' => $data['jumlah'],
            'jadwal_booking' => $data['jadwal_booking'],
            'pembayaran' => $data['pembayaran'],
            'bukti_transfer' => $bukti,
            'total' => $total,
        ]);

        return redirect()->route('transaksi-layanan.invoice', ['id' => $transaksi->id_transaksi_layanan])->with('success', 'Transaksi berhasil!');
    }
    public function invoice($id)
    {
        $transaksi = TransaksiLayanan::with(['layanan', 'alamat', 'user'])->findOrFail($id);

        // Pastikan hanya user yang punya transaksi bisa lihat invoicenya
        if ($transaksi->user_id !== Auth::id()) {
            return redirect()->route('layanan.index')->with('error', 'Anda tidak memiliki akses ke invoice ini.');
        }

        // Nomor WhatsApp owner
        $ownerPhone = '6281216237388'; // Ganti dengan nomor WhatsApp owner

        // Pesan WhatsApp
        $waMessage = "Halo, berikut adalah detail transaksi layanan:\n\n" .
            "Nama Customer: {$transaksi->user->name}\n" .
            "Email: {$transaksi->user->email}\n" .
            "Tanggal Transaksi: {$transaksi->created_at->format('d M Y H:i')}\n" .
            "Layanan: {$transaksi->layanan->nama_layanan}\n" .
            "Jumlah: {$transaksi->jumlah}\n" .
            "Total: Rp" . number_format($transaksi->total, 0, ',', '.') . "\n" .
            "Metode Pembayaran: " . ucfirst($transaksi->pembayaran) . "\n" .
            "Jadwal Booking: " . \Carbon\Carbon::parse($transaksi->jadwal_booking)->format('d M Y H:i') . "\n" .
            "Alamat Instalasi: {$transaksi->alamat->detail_alamat}";

        return view('transaksi-layanan.invoice', compact('transaksi', 'ownerPhone', 'waMessage'));
    }
}

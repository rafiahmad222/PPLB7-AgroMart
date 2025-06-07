<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatusController extends Controller
{
    public function index(Request $request)
    {
        $currentStatus = $request->query('status');

        // Get ALL pesanans for summary statistics (unfiltered)
        $allPesanans = Pesanan::with(['user', 'produk', 'alamat.kecamatan', 'alamat.kabupatenKota', 'alamat.kodePos'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Get filtered pesanans based on status (if a status filter is applied)
        $pesanans = Pesanan::with(['user', 'produk', 'alamat.kecamatan', 'alamat.kabupatenKota', 'alamat.kodePos']);

        if ($currentStatus) {
            $pesanans = $pesanans->where('status', $currentStatus);
        }

        $pesanans = $pesanans->orderBy('created_at', 'desc')->get();

        $kategoris = Kategori::all(); // Assuming you need this for your navigation
        $listTahun = Pesanan::selectRaw('YEAR(created_at) as tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun')
            ->toArray();

        return view('status', compact('pesanans', 'allPesanans', 'kategoris', 'listTahun'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Diproses,Dikirim,Diterima',
        ]);

        $pesanan = Pesanan::findOrFail($id);
        $pesanan->status = $request->status;
        $pesanan->save();

        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }

    public function chartData(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        $query = Pesanan::with(['produk.kategori'])
            ->when($bulan, fn($q) => $q->whereMonth('created_at', $bulan))
            ->when($tahun, fn($q) => $q->whereYear('created_at', $tahun));

        $data = $query->get()
            ->groupBy(fn($item) => $item->produk->kategori->nama_kategori ?? 'Lainnya')
            ->map(fn($group) => $group->sum('jumlah'));

        return response()->json([
            'labels' => $data->keys(),
            'values' => $data->values(),
        ]);
    }
}

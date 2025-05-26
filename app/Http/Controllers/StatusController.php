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
        $listTahun = Pesanan::selectRaw('YEAR(created_at) as tahun')
                        ->distinct()
                        ->orderBy('tahun', 'desc')
                        ->pluck('tahun');

        $status = $request->query('status');

        $query = Pesanan::query()
            ->where('status', '!=', 'Selesai');

        if ($status) {
            $query->where('status', $status);
        }

        $pesanans = $query->get();
        $kategoris = Kategori::all();

        return view('dashboard', compact('kategoris', 'pesanans', 'listTahun'));
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
            ->when($bulan, fn ($q) => $q->whereMonth('created_at', $bulan))
            ->when($tahun, fn ($q) => $q->whereYear('created_at', $tahun));

        $data = $query->get()
            ->groupBy(fn ($item) => $item->produk->kategori->nama_kategori ?? 'Lainnya')
            ->map(fn ($group) => $group->sum('jumlah'));

        return response()->json([
            'labels' => $data->keys(),
            'values' => $data->values(),
        ]);
    }
}

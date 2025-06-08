<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Produk;
use Carbon\Carbon;

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

        //hitung total jumlah pendapatan
        $totalPendapatan = $allPesanans->sum(function ($pesanan) {
            return $pesanan->total;
        });

        $totalProduk = $allPesanans->sum(function ($pesanan) {
            return $pesanan->jumlah;
        });

        // Ambil produk terlaris (5 teratas)
        $produkTerlaris = DB::table('pesanans')
            ->select(
                'produks.id_produk',
                'produks.nama_produk',
                'produks.harga_produk',
                'produks.jumlah_stok',
                'produks.gambar_produk',
                DB::raw('SUM(pesanans.jumlah) as total_terjual'),
                DB::raw('SUM(pesanans.total) as total_pendapatan')
            )
            ->join('produks', 'pesanans.produk_id', '=', 'produks.id_produk')
            ->where('pesanans.status', 'Selesai')
            ->groupBy('produks.id_produk', 'produks.nama_produk', 'produks.harga_produk', 'produks.jumlah_stok', 'produks.gambar_produk')
            ->orderBy('total_terjual', 'desc')
            ->limit(5)
            ->get();

        // Ambil data kategori terlaris
        // Ambil data kategori terlaris
        $kategoriTerlaris = Kategori::select(
            'kategoris.id_kategori',
            'kategoris.nama_kategori',
            DB::raw('COUNT(pesanans.id_pesanan) as total_produk')
        )
            ->join('produks', 'kategoris.id_kategori', '=', 'produks.id_kategori')
            ->join('pesanans', 'produks.id_produk', '=', 'pesanans.produk_id')
            ->where('pesanans.status', 'Selesai')
            ->groupBy('kategoris.id_kategori', 'kategoris.nama_kategori')
            ->orderBy('total_produk', 'desc')
            ->limit(5)
            ->get();

        $totalProdukKategori = Pesanan::where('status', 'Selesai')->count();

        // Ambil statistik bulan ini dan bulan lalu
        $bulanIni = Carbon::now()->startOfMonth();
        $bulanLalu = Carbon::now()->subMonth()->startOfMonth();

        $pesananBulanIni = Pesanan::whereDate('created_at', '>=', $bulanIni)->count();
        $pesananBulanLalu = Pesanan::whereDate('created_at', '>=', $bulanLalu)
            ->whereDate('created_at', '<', $bulanIni)
            ->count();

        // Tambahkan variabel ke view
        return view('status', compact(
            'pesanans',
            'allPesanans',
            'totalPendapatan',
            'totalProduk',
            'kategoris',
            'listTahun',
            'produkTerlaris',
            'kategoriTerlaris',
            'totalProdukKategori',
            'pesananBulanIni',
            'pesananBulanLalu'
        ));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Diproses,Dikirim,Diterima,Selesai',
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

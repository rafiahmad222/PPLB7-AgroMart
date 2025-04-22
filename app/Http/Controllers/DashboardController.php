<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');

        $query = Pesanan::query()
            ->where('status', '!=', 'Selesai');

        if ($status) {
            $query->where('status', $status);
        }

        $pesanans = $query->get();
        $kategoris = Kategori::all();

        return view('dashboard', compact('kategoris', 'pesanans'));
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
}

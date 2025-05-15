<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Layanan;
use App\Models\Kategori;

class LayananController extends Controller
{
    public function index()
    {
        $layanans = Layanan::all();
        $kategoris = Kategori::all();
        return view('layanan.index', compact('layanans', 'kategoris'));
    }

    public function create()
    {
        return view('layanan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'gambar_layanan' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'harga_layanan' => 'required|numeric|min:0',
            'deskripsi_layanan' => 'nullable|string',
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar_layanan')) {
            $gambarPath = $request->file('gambar_layanan')->store('layanan_images', 'public');
        }

        Layanan::create([
            'nama_layanan' => $request->nama_layanan,
            'gambar_layanan' => $gambarPath,
            'harga_layanan' => $request->harga_layanan,
            'deskripsi_layanan' => $request->deskripsi_layanan,
        ]);

        return redirect()->route('layanan.index')->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kategoris = Kategori::all();
        $layanan = Layanan::findOrFail($id);
        return view('layanan.edit', compact('layanan', 'kategoris'));
    }

    public function show($id)
    {
        $layanan = Layanan::findOrFail($id);
        return view('layanan.show', compact('layanan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'gambar_layanan' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'harga_layanan' => 'required|numeric|min:0',
            'deskripsi_layanan' => 'nullable|string',
        ]);

        $layanan = Layanan::findOrFail($id);
        $layanan->nama_layanan = $request->nama_layanan;
        $layanan->harga_layanan = $request->harga_layanan;
        $layanan->deskripsi_layanan = $request->deskripsi_layanan;

        if ($request->hasFile('gambar_layanan')) {
            // Hapus gambar lama jika ada
            if ($layanan->gambar_layanan && file_exists(public_path('storage/' . $layanan->gambar_layanan))) {
                unlink(public_path('storage/' . $layanan->gambar_layanan));
            }
            $layanan->gambar_layanan = $request->file('gambar_layanan')->store('layanan_images', 'public');
        }

        $layanan->save();

        return redirect()->route('layanan.edit', $layanan->id_layanan)->with('success', 'Informasi layanan berhasil diperbarui.');
    }
}

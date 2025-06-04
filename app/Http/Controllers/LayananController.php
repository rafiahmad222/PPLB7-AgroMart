<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Layanan;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;

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
        try {
            $request->validate([
                'nama_layanan' => 'required|string|max:255',
                'harga_layanan' => 'required|numeric',
                'deskripsi_layanan' => 'required|string',
            ]);

            // Cek apakah ada data gambar yang dikirim
            if ($request->has('cropped_image') && $request->cropped_image) {
                // Ekstrak data image dari base64
                $image_parts = explode(";base64,", $request->cropped_image);

                // Jika format data benar
                if (count($image_parts) == 2) {
                    $image_base64 = base64_decode($image_parts[1]);

                    // Buat nama file unik
                    $fileName = 'layanan_' . time() . '.png';
                    $filePath = 'layanan/' . $fileName;

                    // Simpan file ke storage
                    Storage::disk('public')->put($filePath, $image_base64);

                    // Buat record layanan dengan path file
                    Layanan::create([
                        'nama_layanan' => $request->nama_layanan,
                        'harga_layanan' => $request->harga_layanan,
                        'deskripsi_layanan' => $request->deskripsi_layanan,
                        'gambar_layanan' => $filePath,
                    ]);

                    return redirect()->route('layanan.index')->with('success', 'Layanan berhasil ditambahkan!');
                }
            }

            // Jika tidak ada gambar atau format tidak sesuai
            return redirect()->back()
                ->withInput()
                ->withErrors(['gambar_layanan' => 'Gambar layanan wajib diisi dengan format yang sesuai.']);
        } catch (\Exception $e) {

            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data. ' . $e->getMessage()]);
        }
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

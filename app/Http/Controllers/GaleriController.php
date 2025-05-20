<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galeri;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Kategori;

class GaleriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all();
        $galeris = Galeri::with('user')->latest()->paginate(12);
        return view('galeri.index', compact('galeris', 'kategoris'));
    }

    public function create()
    {
        return view('galeri.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ], [
            'required' => ':attribute wajib diisi',
            'image' => 'File harus berupa gambar',
            'mimes' => 'Format gambar harus jpeg, png, atau jpg',
            'max' => 'Ukuran gambar maksimal 2MB'
        ]);

        try {
            $gambar = $request->file('gambar')->store('galeri', 'public');

            Galeri::create([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'gambar' => $gambar,
                'user_id' => Auth::id()
            ]);

            return redirect()->route('galeri.create')
                ->with('success', 'Data galeri berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data']);
        }
    }
    public function edit($id)
    {
        $galeri = Galeri::findOrFail($id);
        return view('galeri.edit', compact('galeri'));
    }

    public function update(Request $request, $id)
    {
        $galeri = Galeri::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi
        ];

        if ($request->hasFile('gambar')) {
            // Delete old image
            Storage::disk('public')->delete($galeri->gambar);

            // Store new image
            $data['gambar'] = $request->file('gambar')->store('galeri', 'public');
        }

        $galeri->update($data);

        return redirect()->route('galeri.edit', $galeri->id_galeri)
            ->with('success', 'Data galeri berhasil diperbarui');
    }
    public function destroy($id_galeri)
    {
        $galeri = Galeri::findOrFail($id_galeri);

        if (Auth::id() !== $galeri->user_id) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus foto ini.');
        }

        Storage::disk('public')->delete($galeri->gambar);
        $galeri->delete();

        return redirect()->route('galeri.index')->with('success', 'Foto berhasil dihapus dari galeri!');
    }
}

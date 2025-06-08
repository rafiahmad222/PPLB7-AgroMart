<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $kategoriId = $request->route('kategori');

        $query = Produk::query();

        if ($search) {
            $query->where('nama_produk', 'like', "%{$search}%")
                ->orWhere('deskripsi_produk', 'like', "%{$search}%");
        }

        if ($kategoriId) {
            $query->where('id_kategori', $kategoriId);
        }

        $produks = $query->paginate(9);
        $kategoris = Kategori::all();

        if ($request->ajax()) {
            return view('produk._list', compact('produks'))->render();
        }

        return view('produk.index', compact('produks', 'kategoris'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = Kategori::all();
        return view('produk.create', compact('kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate the request
            $validated = $request->validate([
                'nama_produk' => 'required|string|min:3|max:255',
                'harga_produk' => 'required|numeric|min:1',
                'jumlah_stok' => 'required|numeric|min:1',
                'id_kategori' => 'required|exists:kategoris,id_kategori',
                'deskripsi_produk' => 'required|string|min:3|max:305',
                'gambar_produk' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $produk = new Produk();
            $produk->nama_produk = $request->nama_produk;
            $produk->harga_produk = $request->harga_produk;
            $produk->jumlah_stok = $request->jumlah_stok;
            $produk->id_kategori = $request->id_kategori;
            $produk->deskripsi_produk = $request->deskripsi_produk;

            if ($request->hasFile('gambar_produk')) {
                $image = $request->file('gambar_produk');
                $gambarPath = $image->store('gambar_produk', 'public');
                $produk->gambar_produk = $gambarPath;
            }

            $produk->save();

            // Respond based on request type
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Produk berhasil ditambahkan!',
                    'data' => $produk
                ]);
            }

            return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
        } catch (\Exception $e) {
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menambahkan produk: ' . $e->getMessage()
                ], 422);
            }

            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan produk: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $kategoris = Kategori::all();
        $produk = Produk::findOrFail($id);
        return view('produk.show', compact('kategoris', 'produk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        $kategoris = Kategori::all();
        return view('produk.edit', compact('produk', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produk $produk)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'gambar_produk' => 'image|mimes:jpeg,png,jpg|max:2048',
            'jumlah_stok' => 'required|integer',
            'harga_produk' => 'required|numeric',
            'deskripsi_produk' => 'nullable|string',
            'id_kategori' => 'required|exists:kategoris,id_kategori',
        ]);

        if ($request->hasFile('gambar_produk')) {
            $gambarPath = $request->file('gambar_produk')->store('gambar_produk', 'public');
            $produk->update(['gambar_produk' => $gambarPath]);
        }

        $produk->update($request->only('nama_produk', 'jumlah_stok', 'harga_produk', 'deskripsi_produk', 'id_kategori'));

        return redirect()->route('produk.index')->with('success', 'Produk updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        try {
            $produk->delete();

            if (request()->wantsJson() || request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Produk berhasil dihapus!'
                ]);
            }

            return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus!');
        } catch (\Exception $e) {
            if (request()->wantsJson() || request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menghapus produk: ' . $e->getMessage()
                ], 422);
            }

            return redirect()->back()->with('error', 'Gagal menghapus produk: ' . $e->getMessage());
        }
    }
    public function filter(Request $request)
    {
        $kategoriId = $request->get('kategori');
        if ($kategoriId) {
            $produks = Produk::where('id_kategori', $kategoriId)->get();
        } else {
            $produks = Produk::all(); // Semua produk
        }
        return view('produk._list', compact('produks'));
    }
}

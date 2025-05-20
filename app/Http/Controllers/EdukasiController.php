<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Video;
use App\Models\Komentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Kategori;


class EdukasiController extends Controller
{
    use AuthorizesRequests;
    public function index(Request $request)
    {
        $user = Auth::user();
        $kategoris = Kategori::all();
        $search = $request->search;

        $artikels = Artikel::when($search, function ($query) use ($search) {
            $query->where('judul', 'like', "%{$search}%")
                ->orWhere('ringkasan', 'like', "%{$search}%")
                ->orWhere('konten', 'like', "%{$search}%");
        })->with('user')->latest()->paginate(6);

        $videos = Video::when($search, function ($query) use ($search) {
            $query->where('judul', 'like', "%{$search}%")
                ->orWhere('deskripsi', 'like', "%{$search}%");
        })->with('user')->latest()->paginate(6);

        return view('edukasi.index', compact('artikels', 'videos', 'user', 'kategoris', 'search'));
    }

    public function create()
    {
        return view('edukasi.create');
    }

    public function store(Request $request)
    {
        try {
            // Validate common fields
            $request->validate([
                'tipe' => 'required|in:artikel,video',
                'judul' => 'required|string|max:255',
            ], [
                'required' => ':attribute wajib diisi',
                'in' => ':attribute tidak valid',
                'max' => ':attribute tidak boleh lebih dari :max karakter',
            ]);

            if ($request->tipe == 'artikel') {
                // Validate artikel fields
                $request->validate([
                    'ringkasan' => 'required|string|max:500',
                    'konten' => 'required|string',
                    'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                ], [
                    'required' => ':attribute wajib diisi',
                    'string' => ':attribute harus berupa teks',
                    'max' => ':attribute tidak boleh lebih dari :max karakter',
                    'image' => 'File harus berupa gambar',
                    'mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
                    'max' => 'Ukuran gambar tidak boleh lebih dari 2MB',
                ]);

                $artikel = new Artikel();
                $artikel->judul = $request->judul;
                $artikel->ringkasan = $request->ringkasan;
                $artikel->konten = $request->konten;
                $artikel->user_id = Auth::id();

                if ($request->hasFile('gambar')) {
                    $path = $request->file('gambar')->store('artikels', 'public');
                    $artikel->gambar = $path;
                }

                $artikel->save();

                return redirect()->route('edukasi.create')
                    ->with('success', 'Artikel berhasil ditambahkan');
            } else {
                // Validate video fields
                $request->validate([
                    'deskripsi' => 'required|string|max:500',
                    'youtube_id' => 'required|string|max:255',
                ], [
                    'required' => ':attribute wajib diisi',
                    'string' => ':attribute harus berupa teks',
                    'max' => ':attribute tidak boleh lebih dari :max karakter',
                ]);

                $video = new Video();
                $video->judul = $request->judul;
                $video->deskripsi = $request->deskripsi;
                $video->youtube_id = $this->extractYoutubeId($request->youtube_id);
                $video->user_id = Auth::id();
                $video->save();

                return redirect()->route('edukasi.create')
                    ->with('success', 'Video berhasil ditambahkan');
            }
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors(['error' => 'Data tidak sesuai/ Data wajib diisi']);
        }
    }

    private function extractYoutubeId($url)
    {
        // Extract YouTube ID from URL if full URL is provided
        if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $url, $matches)) {
            return $matches[1];
        }
        if (preg_match('/youtu\.be\/([^\&\?\/]+)/', $url, $matches)) {
            return $matches[1];
        }
        // If it's already an ID, return as is
        return $url;
    }

    public function show($id_artikel)
    {
        $artikel = Artikel::with(['user', 'komentar.user'])->findOrFail($id_artikel);
        return view('edukasi.show', compact('artikel'));
    }

    public function edit($id_artikel)
    {
        $artikel = Artikel::findOrFail($id_artikel);

        $this->authorize('update', $artikel);

        return view('edukasi.edit', compact('artikel'));
    }

    public function update(Request $request, $id)
    {
        $artikel = Artikel::findOrFail($id);

        $this->authorize('update', $artikel);

        $request->validate([
            'judul' => 'required|string|max:255',
            'ringkasan' => 'required|string|max:500',
            'konten' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $artikel->judul = $request->judul;
        $artikel->ringkasan = $request->ringkasan;
        $artikel->konten = $request->konten;

        if ($request->hasFile('gambar')) {
            // Delete old image if exists
            if ($artikel->gambar) {
                Storage::disk('public')->delete($artikel->gambar);
            }

            $path = $request->file('gambar')->store('artikels', 'public');
            $artikel->gambar = $path;
        }

        $artikel->save();

        return redirect()->route('edukasi.show', $artikel->id_artikel)->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy($id_artikel)
    {
        $artikel = Artikel::findOrFail($id_artikel);

        $this->authorize('delete', $artikel);

        // Delete image if exists
        if ($artikel->gambar) {
            Storage::disk('public')->delete($artikel->gambar);
        }

        $artikel->delete();

        return redirect()->route('edukasi.index')->with('success', 'Artikel berhasil dihapus!');
    }

    public function editVideo($id_video)
    {
        $video = Video::findOrFail($id_video);

        // Hanya pemilik video yang dapat mengedit
        if (Auth::id() != $video->user_id) {
            return redirect()->route('edukasi.index', ['tab' => 'video'])
                ->with('error', 'Anda tidak memiliki izin untuk mengedit video ini!');
        }

        return view('edukasi.edit-video', compact('video'));
    }
    public function updateVideo(Request $request, $id_video)
    {
        $video = Video::findOrFail($id_video);

        // Hanya pemilik video yang dapat mengupdate
        if (Auth::id() != $video->user_id) {
            return redirect()->route('edukasi.index', ['tab' => 'video'])
                ->with('error', 'Anda tidak memiliki izin untuk mengupdate video ini!');
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:500',
            'youtube_id' => 'required|string|max:255',
        ]);

        $video->judul = $request->judul;
        $video->deskripsi = $request->deskripsi;
        $video->youtube_id = $this->extractYoutubeId($request->youtube_id);
        $video->save();

        return redirect()->route('edukasi.index', ['tab' => 'video'])
            ->with('success', 'Video berhasil diperbarui!');
    }
    public function destroyVideo($id_video)
    {
        $video = Video::findOrFail($id_video);

        // Authorize: only owner can delete
        if (Auth::id() != $video->user_id) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus video ini!');
        }

        $video->delete();

        return redirect()->route('edukasi.index', ['tab' => 'video'])->with('success', 'Video berhasil dihapus!');
    }
    public function storeKomentar(Request $request, $artikelId)
    {
        $request->validate([
            'konten' => 'required|string|max:1000',
        ]);

        $komentar = new Komentar();
        $komentar->konten = $request->konten;
        $komentar->user_id = Auth::id();
        $komentar->artikel_id = $artikelId;
        $komentar->save();

        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan!');
    }

    public function destroyKomentar($artikelId, $komentarId)
    {
        $komentar = Komentar::findOrFail($komentarId);

        // Authorize: user can delete their own comment or if they are the article owner
        if (Auth::id() == $komentar->user_id || Auth::id() == $komentar->artikel->user_id) {
            $komentar->delete();
            return redirect()->back()->with('success', 'Komentar berhasil dihapus!');
        }

        return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus komentar ini!');
    }
}

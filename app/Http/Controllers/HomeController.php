<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Layanan;
use App\Models\Video;
use App\Models\Galeri;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $produks = Produk::all();
        $kategoris = Kategori::all();
        $layanans = Layanan::all();
        $artikels = Artikel::all();
        $videos = Video::all();
        $galeris = Galeri::all();

        return view('home', compact('user', 'produks', 'kategoris', 'layanans', 'artikels', 'videos', 'galeris'));
    }
}

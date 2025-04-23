<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
{
    $user = Auth::user();
    $kategoris = Kategori::all();
    return view('home', compact('kategoris', 'user'));
}

}


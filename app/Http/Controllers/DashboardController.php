<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all(); 
        return view('dashboard', compact('kategoris'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserShowController extends Controller
{
    public function showUser()
    {
        $users = User::where('role', 'user')
        ->with(['alamat.kecamatan', 'alamat.kabupatenKota', 'alamat.kodePos'])
        ->get();
        return view('profile.adminshowuser', compact('users'));
    }
}

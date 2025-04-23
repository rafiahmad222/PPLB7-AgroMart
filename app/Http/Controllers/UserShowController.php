<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserShowController extends Controller
{
    public function showUser()
    {
        $users = User::where('role', 'user')->get();
        return view('profile.adminshowuser', compact('users'));
    }
}

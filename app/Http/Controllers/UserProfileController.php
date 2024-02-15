<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function index()
    {
        $user = User::find(auth()->user()->id);
        return view('profile.index', compact('user'));
    }
}

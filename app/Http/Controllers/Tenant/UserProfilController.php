<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserProfilController extends Controller
{
    public function index()
    {
        $user = User::find(auth()->user()->id);
        return view('app.profile.index', compact('user'));
    }
}

<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersMasjidController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        return view('app.users-masjid.index', compact('users'));
    }

    public function create()
    {
        return view('app.users-masjid.create');
    }
}

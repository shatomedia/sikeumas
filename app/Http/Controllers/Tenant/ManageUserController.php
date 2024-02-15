<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManageUserController extends Controller
{
    public function index()
    {
        return view('app.manage-user.index');
    }

    public function create()
    {
        return view('app.manage-user.create');
    }

    
}

<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data['tenant'] = Tenant::get();
        $data['user'] = User::get();
        return view('dashboard.index', $data);
    }
}

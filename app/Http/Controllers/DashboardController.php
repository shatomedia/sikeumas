<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function index()
    {
        $data['tenant'] = Tenant::get();
        $data['staffs'] = Role::where('name', 'staff')->first();
        $data['resellers'] = Role::where('name', 'reseller')->first();
        return view('dashboard.index', $data);
    }
}

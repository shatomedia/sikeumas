<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:masjid', ['only' => ['index']]);
        $this->middleware('permission:create-masjid', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-masjid', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-masjid', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listTenant = Tenant::with('domains')->get();
        return view('manaj_tenants.index', compact('listTenant'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manaj_tenants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'nama_masjid' => 'required',
            'email' => 'required',
            'telp' => 'required',
            'domain' => 'required|unique:domains,domain',
            'password' => 'required',
        ]);

        $tenant = Tenant::create($requestData);
        $tenant->domains()->create(['domain' => $requestData['domain'] . '.' . env('APP_CENTRAL_DOMAIN')]);

        return redirect()->route('tenant.index')->with('success', 'Tenant created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tenant $tenant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tenant $tenant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenant $tenant)
    {
        //
    }
}

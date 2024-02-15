<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Tenant\Masjid;
use Illuminate\Http\Request;

class MasjidController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $masjid = Masjid::all();
        return view('app.masjid.index', compact('masjid'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Masjid $masjid)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $masjid = Masjid::findOrFail($id);
        return view('app.masjid.edit', compact('masjid'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $requestData = $request->validate([
            'telp' => 'required',
            'email' => 'required|email',
        ]);

        $masjid = Masjid::findOrFail($id);
        $masjid->update($requestData);

        return redirect()->route('masjid.index')->with('success', 'Data masjid berhasil diubah.');
    }
}

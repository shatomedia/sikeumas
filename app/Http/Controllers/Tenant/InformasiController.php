<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Tenant\Informasi;
use App\Http\Requests\StoreInformasiRequest;
use App\Http\Requests\UpdateInformasiRequest;
use App\Models\Tenant\Category;
use Illuminate\Http\Request;

class InformasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agendas = Informasi::latest()->paginate(10);
        return view('app.informasi.index', compact('agendas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['profile'] = new Informasi();
        $data['route'] = 'informasi.store';
        $data['method'] = 'POST';
        $data['listKategori'] = Category::pluck('nama', 'id');
        return view('app.informasi.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'kategori_id' => 'required',
            'tanggal' => 'required|date',
            'judul' => 'required',
            'konten' => 'required',
            'gambar' => 'required|max:2048'
        ]);
        // dd($request->gambar);
        $fileName = time() . rand(1, 200) . '.' . $request->file('gambar')->getClientOriginalExtension();
        $request->file('gambar')->move(public_path('uploads'), $fileName);

        $requestData['gambar'] = $fileName;

        Informasi::create($requestData);

        return redirect()->route('informasi.index')->with('success', 'Informasi berhasil ditambahkan');
    }


    /**
     * Display the specified resource.
     */
    public function show(Informasi $informasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Informasi $informasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInformasiRequest $request, Informasi $informasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Informasi $informasi)
    {
        //
    }
}

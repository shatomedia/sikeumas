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
    public function edit($id)
    {
        $data['profile'] = Informasi::findorFail($id);
        $data['route'] = 'informasi.update';
        $data['method'] = 'PUT';
        $data['listKategori'] = Category::pluck('nama', 'id');
        return view('app.informasi.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Informasi $informasi)
    {
        // Validasi input
        $requestData = $request->validate([
            'kategori_id' => 'required',
            'tanggal' => 'required|date',
            'judul' => 'required',
            'konten' => 'required',
            'gambar' => 'nullable|max:2048' // Tidak wajib diisi
        ]);

        // Ambil data yang sudah ada di database
        $oldData = $informasi->refresh();

        // Perbarui nilai-nilai yang tidak diubah
        foreach ($requestData as $key => $value) {
            if (!isset($requestData[$key]) || $requestData[$key] === $oldData->$key) {
                $requestData[$key] = $oldData->$key;
            }
        }

        // Jika ada gambar baru diunggah, proses gambar tersebut
        if ($request->hasFile('gambar')) {
            $fileName = time() . rand(1, 200) . '.' . $request->file('gambar')->getClientOriginalExtension();
            $request->file('gambar')->move(public_path('uploads'), $fileName);
            $requestData['gambar'] = $fileName;

            // Hapus gambar lama
            if (file_exists(public_path('uploads/' . $oldData->gambar))) {
                unlink(public_path('uploads/' . $oldData->gambar));
            }
        }

        // Lakukan pembaruan data
        $informasi->update($requestData);

        return redirect()->route('informasi.index')->with('success', 'Informasi berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Informasi $informasi)
    {
        //
    }
}

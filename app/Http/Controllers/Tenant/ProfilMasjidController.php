<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Tenant\Masjid;
use App\Models\Tenant\ProfilMasjid;
use Illuminate\Http\Request;

class ProfilMasjidController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile = ProfilMasjid::latest()->paginate(10);
        return view('app.profile_masjid.index', compact('profile'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['profile'] = new ProfilMasjid();
        $data['route'] = 'profil-masjid.store';
        $data['method'] = 'POST';
        $data['listKategori'] = [
            'visi' => 'Visi',
            'misi' => 'Misi',
            'sejarah' => 'Sejarah',
            'struktur-organisasi' => 'Struktur Organisasi',
        ];
        $masjid = Masjid::first();

        return view('app.profile_masjid.create', compact('data', 'masjid'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'kategori' => 'required',
            'judul' => 'required',
            'konten' => 'required',
        ]);

        ProfilMasjid::create($requestData);

        return redirect()->route('profile-masjid.index')->with('success', 'Data berhasil ditambahkan');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = ProfilMasjid::findorFail($id);
        return view('app.profile_masjid.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['profile'] = ProfilMasjid::findorFail($id);
        $data['route'] = 'profile.masjid.update';
        $data['method'] = 'PUT';
        $data['listKategori'] = [
            'visi' => 'Visi',
            'misi' => 'Misi',
            'sejarah' => 'Sejarah',
            'struktur-organisasi' => 'Struktur Organisasi',
        ];

        return view('app.profile_masjid.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $requestData = $request->validate([
            'kategori' => 'required',
            'judul' => 'required',
            'konten' => 'required',
        ]);

        $profil = ProfilMasjid::findorFail($id);
        $profil->update($requestData);
        return redirect()->route('profile-masjid.index')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        ProfilMasjid::destroy($id);
        return redirect()->route('profile-masjid.index')->with('success', 'Data berhasil dihapus');
    }
}

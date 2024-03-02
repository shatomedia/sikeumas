<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Tenant\Kurban;
use Illuminate\Http\Request;

class KurbanController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:informasi-kurban', ['only' => ['index']]);
        $this->middleware('permission:create-informasi-kurban', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-informasi-kurban', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-informasi-kurban', ['only' => ['destroy']]);
    }
    public function index()
    {
        $kurbans = Kurban::latest()->paginate(10);
        return view('app.kurban.index', compact('kurbans'));
    }

    public function create()
    {
        return view('app.kurban.create');
    }

    public function store(Request $request)
    {
        $resuestData = $request->validate([
            'tahun_hijriah' => 'required',
            'tahun_masehi' => 'required',
            'tanggal_akhir_pendaftaran' => 'required',
            'konten' => 'required',
        ]);

        Kurban::create($resuestData);

        return redirect()->route('kurban.index')->with('success', 'Kurban created successfully.');
    }

    public function show(Kurban $kurban)
    {
        return view('app.kurban.show', compact('kurban'));
    }

    public function edit(Kurban $kurban)
    {
        return view('app.kurban.edit', compact('kurban'));
    }

    public function update(Request $request, Kurban $kurban)
    {
        $resuestData = $request->validate([
            'tahun_hijriah' => 'required',
            'tahun_masehi' => 'required',
            'tanggal_akhir_pendaftaran' => 'required',
            'konten' => 'required',
        ]);

        $kurban->update($resuestData);

        return redirect()->route('kurban.index')->with('success', 'Kurban updated successfully.');
    }

    public function destroy(Kurban $kurban)
    {
        $kurban->delete();

        return redirect()->route('kurban.index')->with('success', 'Kurban deleted successfully.');
    }
}

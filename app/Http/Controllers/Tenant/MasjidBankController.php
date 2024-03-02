<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Tenant\Bank;
use App\Models\Tenant\MasjidBank;
use Illuminate\Http\Request;

class MasjidBankController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:bank', ['only' => ['index']]);
        $this->middleware('permission:create-bank', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-bank', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-bank', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $banks = MasjidBank::get();
        return view('app.bank_masjid.index', compact('banks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $listBank = Bank::pluck('nama_bank', 'id');
        return view('app.bank_masjid.create', compact('listBank'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'bank_id' => 'required|exists:banks,id',
            'nama_rekening' => 'required',
            'nomor_rekening' => 'required',
        ]);
        $bank = Bank::findOrfail($requestData['bank_id']);
        unset($requestData['bank_id']);
        $requestData['kode_bank'] = $bank->sandi_bank;
        $requestData['nama_bank'] = $bank->nama_bank;

        MasjidBank::create($requestData);

        return redirect()->route('masjid-bank.index')->with('success', 'Data berhasil ditambahkan');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = MasjidBank::find($id);
        $listBank = Bank::pluck('nama_bank', 'id');
        return view('app.bank_masjid.edit', compact('data', 'listBank'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $requestData = $request->validate([
            'bank_id' => 'required|exists:banks,id',
            'nama_rekening' => 'required',
            'nomor_rekening' => 'required',
        ]);
        $bank = Bank::findOrfail($requestData['bank_id']);
        unset($requestData['bank_id']);
        $requestData['kode_bank'] = $bank->sandi_bank;
        $requestData['nama_bank'] = $bank->nama_bank;

        $masjidBank = MasjidBank::findorFail($id);
        $masjidBank->update($requestData);

        return redirect()->route('masjid-bank.index')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        MasjidBank::destroy($id);
        return redirect()->route('masjid-bank.index')->with('success', 'Data berhasil dihapus');
    }
}

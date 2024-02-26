<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Tenant\Infaq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InfaqController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:infaq', ['only' => ['index']]);
        $this->middleware('permission:create-infaq', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-infaq', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-infaq', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Infaq::query();
        if ($request->filled('tanggal_mulai')) {
            $query->whereDate('created_at', '>=', $request->tanggal_mulai);
        }
        if ($request->filled('tanggal_selesai')) {
            $query->whereDate('created_at', '<=', $request->tanggal_selesai);
        }

        $query = $query->latest()->paginate(10);
        if ($request->page == 'laporan') {
            // return view('admin.kas.laporan', compact('kasList', 'saldoAkhir', 'totalPemasukan', 'totalPengeluaran', 'masjid'));
        }
        return view('app.infaq.index', compact('query'));
    }

    private function listSumberInfaq()
    {
        return [
            'kotak-amal-jumat' => 'Kotak amal jumat',
            'instansi' => 'Instansi',
            'perorangan' => 'Perorangan',
            'lainnya' => 'Lainnya',
        ];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $listSumberInfaq = $this->listSumberInfaq();
        return view('app.infaq.create', compact('listSumberInfaq'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'created_at' => 'required|date',
            'sumber' => 'required',
            'atas_nama' => 'nullable',
            'jenis' => 'required',
            'satuan' => 'required',
            'jumlah' => 'required|numeric',
        ]);

        try {
            DB::beginTransaction();
            $requestData['atas_nama'] = $requestData['atas_nama'] ?? 'Hamba Allah';
            $infaq = Infaq::create($requestData);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error', 'Data infaq gagal ditambahkan, error: ' . $e->getMessage());
        }

        return redirect()->route('infaq.index')->with('success', 'Data infaq berhasil ditambahkan dan tersimpan di kas masjid.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Infaq $infaq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $infaq = Infaq::findOrFail($id);
        $listSumberInfaq = $this->listSumberInfaq();
        return view('app.infaq.edit', compact('infaq', 'listSumberInfaq'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $requestData = $request->validate([
            'created_at' => 'required|date',
            'sumber' => 'required',
            'atas_nama' => 'nullable',
            'jenis' => 'required',
            'satuan' => 'required',
            'jumlah' => 'required|numeric',
        ]);

        try {
            DB::beginTransaction();
            $infaq = Infaq::findOrFail($id);
            $infaq->update($requestData);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error', 'Data infaq gagal diperbarui, error: ' . $e->getMessage());
        }

        return redirect()->route('infaq.index')->with('success', 'Data infaq berhasil diperbarui.');
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $infaq = Infaq::findOrFail($id);
            $infaq->delete();
            DB::commit();

            return redirect()->route('infaq.index')->with('success', 'Data infaq berhasil dihapus.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            DB::rollBack();
            return back()->with('error', 'Data infaq tidak ditemukan.');
        }
    }
}

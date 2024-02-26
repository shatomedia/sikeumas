<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Tenant\Kas;
use App\Models\Tenant\Masjid;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class KasController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:kas', ['only' => ['index']]);
        $this->middleware('permission:create-kas', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-kas', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-kas', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Kas::query();
        if ($request->filled('tanggal_mulai')) {
            $query->whereDate('tanggal', '>=', $request->tanggal_mulai);
        }
        if ($request->filled('tanggal_selesai')) {
            $query->whereDate('tanggal', '<=', $request->tanggal_selesai);
        }

        /** @var \Illuminate\Support\Collection|\Illuminate\Pagination\LengthAwarePaginator $kasList */
        $kasList = $query->latest()->paginate(10);
        $masjid = Masjid::first();
        $saldoAkhir = Kas::SaldoAkhir();
        $totalPemasukan =  $kasList->where('jenis', 'masuk')->sum('jumlah');
        $totalPengeluaran =  $kasList->where('jenis', 'keluar')->sum('jumlah');
        if ($request->page == 'laporan') {
            return view('app.kas.laporan', compact('kasList', 'saldoAkhir', 'totalPemasukan', 'totalPengeluaran', 'masjid'));
        }
        return view('app.kas.index', compact('kasList', 'saldoAkhir', 'totalPemasukan', 'totalPengeluaran'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $saldoAkhir = Kas::SaldoAkhir();
        return view('app.kas.create', compact('saldoAkhir'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'tanggal' => 'required|date',
            'kategori' => 'nullable',
            'keterangan' => 'required',
            'jenis' => 'required|in:masuk,keluar',
            'jumlah' => 'required|numeric',
        ]);

        $tanggal_transaksi = Carbon::parse($requestData['tanggal']);
        $tahunBulanTransakasi = $tanggal_transaksi->format('Ym');
        $tahunBulanSekarang = Carbon::now()->format('Ym');
        if ($tahunBulanTransakasi != $tahunBulanSekarang) {
            return redirect()->back()->with('error', 'transaksi hanya bisa dilakukan untuk bulan ini!');
        }

        $kas = new Kas();
        $kas->fill($requestData);
        $kas->save();

        return redirect()->route('kas.index')->with('success', 'Data kas berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kas = Kas::findOrFail($id);
        $saldoAkhir = Kas::SaldoAkhir();
        return view('app.kas.edit', compact('kas', 'saldoAkhir'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $requestData = $request->validate([
            'kategori' => 'nullable|string',
            'keterangan' => 'required|string',
            'jumlah' => 'required',

        ]);


        $kas = Kas::findOrFail($id);

        $kas->fill($requestData);
        $kas->save();

        return redirect()->route('kas.index')->with('success', 'Data kas berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kas = Kas::findOrFail($id);

        if ($kas->infaq_id != null) {
            return redirect()->route('kas.index')->with('error', 'Data kas tidak bisa dihapus karena terkait dengan data infaq! Silahkan hapus melalui menu Data Infaq!');
        }

        $kas->delete();
        return redirect()->route('kas.index')->with('success', 'Data kas disimpan!');
    }
}

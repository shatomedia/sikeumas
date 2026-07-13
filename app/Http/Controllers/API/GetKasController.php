<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Tenant\Kas;
use App\Models\Tenant\Informasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class GetKasController extends Controller
{
    public function index()
    {
        try {
            $kas = Kas::latest()->limit(5)->get();
            return ResponseFormatter::success($kas, 'Data berhasil diambil');
        } catch (\Throwable $th) {
            return ResponseFormatter::error($th->getMessage(), 'Data gagal diambil', 500);
        }
    }
    
    public function saldo(Request $request)
{
    try {
        // --- SALDO ---
        $totalMasuk  = (int) Kas::where('jenis', 'masuk')->sum('jumlah');
        $totalKeluar = (int) Kas::where('jenis', 'keluar')->sum('jumlah');
        $saldo       = $totalMasuk - $totalKeluar;

        // --- INFORMASI TERAKHIR (opsional ?kategori=NamaKategori) ---
        $q = Informasi::query();

        if ($request->filled('kategori')) {
            $nama = $request->input('kategori');
            if (method_exists(Informasi::class, 'kategori')) {
                $q->whereHas('kategori', fn($x) => $x->where('nama', $nama));
            }
        }

        // urut terbaru: pakai 'tanggal' kalau ada, fallback 'created_at'
        $infoTable = (new Informasi)->getTable();
        if (Schema::hasColumn($infoTable, 'tanggal')) {
            $q->orderByDesc('tanggal')->orderByDesc('created_at');
        } else {
            $q->orderByDesc('created_at');
        }

        $terbaru = $q->first();

        // --- BANGUN PAYLOAD FLAT ---
        $payload = ['saldo' => $saldo];

        if ($terbaru) {
            $tanggal = $terbaru->tanggal ?? $terbaru->created_at;
            // pastikan string ISO-8601 jika objek tanggal
            if ($tanggal instanceof \DateTimeInterface) {
                $tanggal = $tanggal->toISOString(); // atau ->toAtomString()
            }

            $payload += [
                'judul'   => $terbaru->judul ?? null,
                'konten'  => $terbaru->konten ?? null, // ganti ke 'isi' jika kolommu bernama 'isi'
            ];
        }

        return response()->json($payload, 200);

    } catch (\Throwable $th) {
        report($th);
        return response()->json([
            'saldo'      => 0,
            'message' => 'Gagal mengambil ringkasan',
        ], 500);
    }
}


}

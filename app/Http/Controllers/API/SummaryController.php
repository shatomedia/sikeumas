<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\Kas;
use App\Models\Tenant\Category;
use App\Models\Tenant\Informasi;

class SummaryController extends Controller
{
    public function index(Request $request)
    {
        // --- SALDO AKHIR ---
        // Ambil saldo_akhir terbaru (urutkan by tanggal lalu id sebagai fallback).
        $saldoAkhir = Kas::orderByDesc('tanggal')
            ->orderByDesc('id')
            ->value('saldo_akhir') ?? 0;

        // --- INFORMASI/ACARA TERAKHIR ---
        $info = Informasi::query();

        if ($request->filled('kategori')) {
            $nama = $request->string('kategori')->toString();
            $info->whereHas('kategori', fn($q) => $q->where('nama', $nama));
        }

        // Utamakan kolom 'tanggal' (jadwal acara), fallback 'created_at'
        $informasiTerakhir = $info
            ->orderByDesc('tanggal')
            ->orderByDesc('created_at')
            ->first();

        // --- RESPON TANPA ResponseFormatter ---
        return response()->json([
            'saldo_akhir' => (int) $saldoAkhir,
            'informasi_terakhir' => $informasiTerakhir, // object atau null
        ], 200);
    }
}

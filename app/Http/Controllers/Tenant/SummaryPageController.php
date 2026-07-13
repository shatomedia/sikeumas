<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Models\Tenant\Kas;
use App\Models\Tenant\Informasi;

class SummaryPageController extends Controller
{
    public function index(Request $request)
    {
        $kategori = $request->query('kategori');

        // ===== SALDO AKHIR (adaptif ke skema) =====
        $kasTable = (new Kas)->getTable();

        if (Schema::hasColumn($kasTable, 'saldo_akhir')) {
            // Ada kolom saldo_akhir di DB → ambil yang terbaru
            $saldoAkhir = (int) Kas::when(
                Schema::hasColumn($kasTable, 'tanggal'),
                fn ($q) => $q->orderByDesc('tanggal')->orderByDesc('id'),
                fn ($q) => $q->orderByDesc('id')
            )->value('saldo_akhir') ?? 0;

        } elseif (Schema::hasColumn($kasTable, 'debit') && Schema::hasColumn($kasTable, 'kredit')) {
            // Ada skema debit/kredit → hitung saldo = sum(debit) - sum(kredit)
            $saldoAkhir = (int) Kas::selectRaw(
                'COALESCE(SUM(debit),0) - COALESCE(SUM(kredit),0) AS saldo'
            )->value('saldo');

        } elseif (Schema::hasColumn($kasTable, 'jenis') && Schema::hasColumn($kasTable, 'jumlah')) {
            // Skema umum: jenis (masuk/keluar), jumlah (angka)
            // Normalisasi beberapa kemungkinan nilai "jenis"
            $saldoAkhir = (int) Kas::selectRaw("
                COALESCE(SUM(CASE WHEN LOWER(jenis) IN ('masuk','pemasukan','in','credit','cr') THEN jumlah ELSE 0 END),0)
              - COALESCE(SUM(CASE WHEN LOWER(jenis) IN ('keluar','pengeluaran','out','debit','dr') THEN jumlah ELSE 0 END),0)
              AS saldo
            ")->value('saldo');

        } else {
            // Tidak ada kolom yang bisa dipakai → anggap 0
            $saldoAkhir = 0;
        }

        // ===== INFORMASI TERAKHIR =====
        $info = Informasi::query();

        if (!empty($kategori) && method_exists(Informasi::class, 'kategori')) {
            $info->whereHas('kategori', fn($q) => $q->where('nama', $kategori));
        }

        $informasiTerakhir = $info
            ->when(
                Schema::hasColumn((new Informasi)->getTable(), 'tanggal'),
                fn ($q) => $q->orderByDesc('tanggal')->orderByDesc('created_at'),
                fn ($q) => $q->orderByDesc('created_at')
            )
            ->first();

        return view('app.summary', [
            'saldoAkhir' => $saldoAkhir,
            'informasi'  => $informasiTerakhir,
            'kategori'   => $kategori,
        ]);
    }
}


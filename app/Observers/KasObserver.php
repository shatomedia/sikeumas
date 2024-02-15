<?php

namespace App\Observers;

use App\Models\Tenant\Kas;
use App\Models\Tenant\Masjid;

class KasObserver
{
    /**
     * Handle events after all transactions are committed.
     * 
     * @var bool
     */
    public $afterCommit = true;

    /**
     * Handle the ModelsTenantKas "created" event.
     */
    public function created(Kas $kas): void
    {
        // Ambil data kas terakhir
        $saldoAkhir = Kas::SaldoAkhir();
        if ($kas->jenis == 'masuk') {
            $saldoAkhir += $kas->jumlah;
        } else {
            $saldoAkhir -= $kas->jumlah;
        }
        // Update saldo akhir masjid
        Masjid::first()->update(['saldo_akhir' => $saldoAkhir]);
    }

    /**
     * Handle the ModelsTenantKas "updated" event.
     */
    public function updated(Kas $kas): void
    {
        // Ambil data kas terakhir
        $saldoAkhir = Kas::SaldoAkhir();
        if ($kas->jenis == 'masuk') {
            $saldoAkhir -= $kas->getOriginal('jumlah');
            $saldoAkhir += $kas->jumlah;
        } else {
            $saldoAkhir += $kas->getOriginal('jumlah');
            $saldoAkhir -= $kas->jumlah;
        }
        // Update saldo akhir masjid
        Masjid::first()->update(['saldo_akhir' => $saldoAkhir]);
    }

    /**
     * Handle the ModelsTenantKas "deleted" event.
     */
    public function deleted(Kas $kas): void
    {
        // Ambil data kas terakhir
        $saldoAkhir = Kas::SaldoAkhir();
        if ($kas->jenis == 'masuk') {
            $saldoAkhir -= $kas->jumlah;
        } else {
            $saldoAkhir += $kas->jumlah;
        }
        // Update saldo akhir masjid
        Masjid::first()->update(['saldo_akhir' => $saldoAkhir]);
    }

    /**
     * Handle the ModelsTenantKas "restored" event.
     */
    public function restored(Kas $kas): void
    {
        //
    }

    /**
     * Handle the ModelsTenantKas "force deleted" event.
     */
    public function forceDeleted(Kas $kas): void
    {
        //
    }
}

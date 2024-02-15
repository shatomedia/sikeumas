<?php

namespace App\Observers;

use App\Models\Tenant\Infaq;
use App\Models\Tenant\Kas;

class InfaqObserver
{
    /**
     * Handle the Infaq "created" event.
     */
    public function created(Infaq $infaq): void
    {
        if ($infaq->jenis == 'uang') {
            try {
                $kas = new Kas();
                $kas->infaq_id = $infaq->id;
                $kas->tanggal = $infaq->created_at;
                $kas->kategori = 'infaq-' . $infaq->sumber;
                $kas->keterangan = 'Infaq ' . $infaq->sumber . ' dari ' . $infaq->atas_nama;
                $kas->jenis = 'masuk';
                $kas->jumlah = $infaq->jumlah;
                $kas->save();
            } catch (\Throwable $th) {
                throw new \Exception('Error, Data kas gagal disimpan');
            }
        }
    }

    /**
     * Handle the Infaq "updated" event.
     */
    public function updated(Infaq $infaq): void
    {
        if ($infaq->jenis == 'uang') {
            try {
                $kas = Kas::where('infaq_id', $infaq->id)->first();
                if ($kas) {
                    $saldoAkhir = Kas::SaldoAkhir() - $kas->jumlah;
                    $kas->delete();
                } else {
                    $saldoAkhir = Kas::SaldoAkhir();
                }

                $saldoAkhir += $infaq->jumlah;
                $newKas = new Kas();
                $newKas->infaq_id = $infaq->id;
                $newKas->tanggal = $infaq->created_at;
                $newKas->kategori = 'infaq-' . $infaq->sumber;
                $newKas->keterangan = 'Infaq ' . $infaq->sumber . ' dari ' . $infaq->atas_nama;
                $newKas->jenis = 'masuk';
                $newKas->jumlah = $infaq->jumlah;
                $newKas->save();
            } catch (\Throwable $th) {
                throw new \Exception('Error, Data kas gagal disimpan');
            }
        }
    }

    /**
     * Handle the Infaq "deleted" event.
     */
    public function deleted(Infaq $infaq): void
    {
        if ($infaq->jenis == 'uang') {
            try {
                if ($infaq->jenis == 'uang') {
                    if ($infaq->kas != null) {
                        $infaq->kas->delete();
                    }
                }
            } catch (\Throwable $th) {
                throw new \Exception('Error, Data kas gagal dihapus');
            }
        }
    }

    /**
     * Handle the Infaq "restored" event.
     */
    public function restored(Infaq $infaq): void
    {
        //
    }

    /**
     * Handle the Infaq "force deleted" event.
     */
    public function forceDeleted(Infaq $infaq): void
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Tenant\Infaq;
use App\Models\Tenant\Kas;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $tahun = date('Y');
        for ($i = 1; $i <= 12; $i++) {
            $totalInfaq = Infaq::whereYear('created_at', $tahun)->whereMonth('created_at', $i)->sum('jumlah');
            $dataBulan[] = ubahAngkaToBulan($i);
            $dataTotalInfaq[] = $totalInfaq;
        }

        $data['dataBulan'] = $dataBulan;
        $data['dataTotalInfaq'] = $dataTotalInfaq;
        $data['saldoAkhir'] = Kas::SaldoAkhir();
        $data['totalInfaq'] = Infaq::whereDate('created_at', now()->format('Y-m-d'))->sum('jumlah');
        $data['totalPengeluaran'] = Kas::whereDate('created_at', now()->format('Y-m-d'))->where('jenis', 'keluar')->sum('jumlah');
        $data['totalPemasukan'] = Kas::whereDate('created_at', now()->format('Y-m-d'))->where('jenis', 'masuk')->sum('jumlah');
        $data['kas'] = Kas::latest()->take(7)->get();
        return view('app.dashboard.index', $data);
    }
}

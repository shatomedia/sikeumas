<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Tenant\Kas;
use App\Models\Tenant\Masjid;
use App\Models\Tenant\MasjidBank;
use App\Models\Tenant\ProfilMasjid;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $data['masjids'] = Masjid::first();
        $data['saldoAkhir'] = Kas::SaldoAkhir();
        $data['kas'] = Kas::latest()->take(5)->get();
        $data['banks'] = MasjidBank::get()->first();
        $data['visi'] = ProfilMasjid::where('kategori', 'visi')->first();
        $data['misi'] = ProfilMasjid::where('kategori', 'misi')->first();
        return view('app.landing_page', $data);
    }
}

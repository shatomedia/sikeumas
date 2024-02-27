<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Tenant\Kas;
use Illuminate\Http\Request;

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
}

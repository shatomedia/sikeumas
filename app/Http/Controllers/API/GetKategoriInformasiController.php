<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Tenant\Category;
use Illuminate\Http\Request;

class GetKategoriInformasiController extends Controller
{
    public function index()
    {
        try {
            $kategori = Category::all();
            return ResponseFormatter::success($kategori, 'Data berhasil diambil');
        } catch (\Throwable $th) {
            return ResponseFormatter::error($th->getMessage(), 'Data gagal diambil', 500);
        }
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Tenant\Category;
use App\Models\Tenant\Informasi;
use Illuminate\Http\Request;

class GetInformasiController extends Controller
{
    public function index(Request $request)
    {
        try {
            // Ambil semua informasi atau informasi berdasarkan kategori jika ada
            if ($request->has('kategori')) {
                $nama_kategori = $request->input('kategori');
                // Dapatkan informasi berdasarkan nama kategori
                $informasi = Informasi::whereHas('kategori', function ($query) use ($nama_kategori) {
                    $query->where('nama', $nama_kategori);
                })->get();
            } else {
                // Ambil semua informasi
                $informasi = Informasi::all();
            }

            return ResponseFormatter::success($informasi, 'Data berhasil diambil');
        } catch (\Throwable $th) {
            return ResponseFormatter::error($th->getMessage(), 500);
        }
    }
}

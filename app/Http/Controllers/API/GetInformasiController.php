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
    
    public function latest(Request $request)
    {
        try {
            $query = Informasi::query();

            // Opsional filter by kategori ?kategori=NamaKategori
            if ($request->filled('kategori')) {
                $nama_kategori = $request->input('kategori');
                $query->whereHas('kategori', function ($q) use ($nama_kategori) {
                    $q->where('nama', $nama_kategori);
                });
            }

            // Ambil 1 paling terbaru berdasarkan created_at
            $terbaru = $query->latest('created_at')->first();

           if (!$terbaru) {
            // tidak ada data, tetap konsisten kembalikan key "result"
            return response()->json([
                'result' => null,
            ], 200);
            }

            // ✅ objek tunggal dalam key "result" dengan field asli model
            return response()->json([
                'result' => $terbaru,
            ], 200);

        } catch (\Throwable $th) {
            return ResponseFormatter::error($th->getMessage(), 500);
        }
    }
}

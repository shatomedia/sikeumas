<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stancl\Tenancy\Database\Models\Domain;

class DomainController extends Controller
{
    // Menampilkan semua domain
    public function index()
    {
        try {
            $domains = Domain::all();

            return ResponseFormatter::success($domains, 'Data domain berhasil diambil');
        } catch (\Throwable $th) {
            return ResponseFormatter::error($th->getMessage(), 'Data domain gagal diambil');
        }
    }

    // Menampilkan detail domain berdasarkan ID
    public function show($id)
    {
        try {
            $domain = Domain::find($id);
            if (!$domain) {
                return ResponseFormatter::error('Data domain tidak ditemukan', 404);
            }

            return ResponseFormatter::success($domain, 'Data domain berhasil diambil');
        } catch (\Throwable $th) {
            return ResponseFormatter::error($th->getMessage(), 'Data domain gagal diambil');
        }
    }
}

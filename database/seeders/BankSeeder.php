<?php

namespace Database\Seeders;

use App\Models\Tenant\Bank;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banks = [
            ['id' => 1, 'sandi_bank' => '002', 'nama_bank' => 'Bank BRI'],
            ['id' => 2, 'sandi_bank' => '008', 'nama_bank' => 'Bank Mandiri'],
            ['id' => 3, 'sandi_bank' => '009', 'nama_bank' => 'Bank BNI'],

        ];

        // Memasukkan data ke dalam tabel 'banks'
        DB::table('banks')->insert($banks);
    }
}

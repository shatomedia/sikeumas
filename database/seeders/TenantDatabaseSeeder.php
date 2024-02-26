<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class TenantDatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::create(['name' => 'ketua']);
        Role::create(['name' => 'sekretaris']);
        Role::create(['name' => 'bendahara']);

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('permissions')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $file = database_path('import/tenant-permissions.csv');
        $handle = fopen($file, "r");

        if ($handle) {
            $header = fgetcsv($handle, 1000, ",");
            while (($data = fgetcsv($handle, 1000, ",", '"')) !== FALSE) {
                DB::table('permissions')->insert([
                    'name' => $data[0],
                    'guard_name' => 'web',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            fclose($handle);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('banks')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $file = database_path('import/bank.csv');
        $handle = fopen($file, "r");

        if ($handle) {
            $header = fgetcsv($handle, 1000, ",");
            while (($data = fgetcsv($handle, 1000, ",", '"')) !== FALSE) {
                DB::table('banks')->insert([
                    'sandi_bank' => $data[0],
                    'nama_bank' => $data[1],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            fclose($handle);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('banks')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $file = database_path('import/bank.csv');
        $handle = fopen($file, "r");

        if ($handle) {
            $header = fgetcsv($handle, 1000, ",");
            while (($data = fgetcsv($handle, 1000, ",", '"')) !== FALSE) {
                DB::table('banks')->insert([
                    'sandi_bank' => $data[0],
                    'nama_bank' => $data[1],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            fclose($handle);
        }
    }
}

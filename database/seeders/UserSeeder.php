<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('permissions')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $file = database_path('import/permissions.csv');
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

        $admin = User::create([
            'name' => 'Shatomedia',
            'email' => 'shatomedia@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);

        // $reseller = User::create([
        //     'name' => 'Reseller',
        //     'email' => 'reseller@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('password'),
        // ]);

        $roleadmin = Role::create(['name' => 'admin']);
        $rolestaff = Role::create(['name' => 'staff']);
        $rolereseller = Role::create(['name' => 'reseller']);

        $admin->assignRole('admin');

        // Assign permissions to roles
        $roleadmin->syncPermissions(Permission::all());

        // Define permissions for staff role
        $staffPermissions = [
            'masjid',
            'create-masjid',
            'edit-masjid'
        ];

        // Sync permissions for staff role
        $rolestaff->syncPermissions($staffPermissions);

        // Define permissions for reseller role
        $resellerPermissions = [
            'masjid',
            'create-masjid',
            'edit-masjid'
        ];

        // Sync permissions for reseller role
        $rolereseller->syncPermissions($resellerPermissions);
    }
}

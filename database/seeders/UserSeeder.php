<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
        $admin = User::create([
            'name' => 'Shatomedia',
            'email' => 'shatomedia@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);

        $reseller = User::create([
            'name' => 'Reseller',
            'email' => 'reseller@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);

        $role = Role::create(['name' => 'admin']);
        $role = Role::create(['name' => 'staff']);
        $role = Role::create(['name' => 'reseller']);

        $permission = Permission::create(['name' => 'create-user']);
        $permission = Permission::create(['name' => 'read-user']);
        $permission = Permission::create(['name' => 'update-user']);
        $permission = Permission::create(['name' => 'delete-user']);

        $admin->assignRole('admin');
        $reseller->assignRole('reseller');
    }
}

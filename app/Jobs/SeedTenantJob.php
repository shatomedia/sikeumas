<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Tenant;
use App\Models\Tenant\Masjid;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SeedTenantJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $tenant;
    public function __construct(Tenant $tenant)
    {
        $this->tenant = $tenant;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->tenant->run(function () {
            $user = User::create([
                'name' => $this->tenant->nama,
                'email' => $this->tenant->email,
                'password' => $this->tenant->password,
            ]);

            $role = Role::where('name', 'ketua')->first();

            // Tetapkan peran "ketua" kepada pengguna
            $user->assignRole($role);

            // Sinkronkan daftar permission untuk peran "ketua"
            $role->syncPermissions(Permission::all());

            Masjid::create([
                'nama' => $this->tenant->nama_masjid,
                'alamat' => $this->tenant->alamat,
                'telp' => $this->tenant->telp,
                'email' => $this->tenant->email,
            ]);
        });
    }

    protected function addAllPermissions($user)
    {
        // Ambil semua permission yang tersedia
        $permissions = Permission::all();

        // Tambahkan setiap permission kepada pengguna dengan peran "ketua"
        $user->givePermissionTo($permissions);
    }
}

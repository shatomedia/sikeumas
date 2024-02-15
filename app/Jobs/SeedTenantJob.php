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

            $user->assignRole('ketua');

            Masjid::create([
                'nama' => $this->tenant->nama_masjid,
                'alamat' => $this->tenant->alamat,
                'telp' => $this->tenant->telp,
                'email' => $this->tenant->email,
            ]);
        });
    }
}

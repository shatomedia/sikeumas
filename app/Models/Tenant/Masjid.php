<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Masjid extends Model
{
    use HasFactory;
    protected $table = 'masjids';
    protected $fillable = [
        'nama',
        'alamat',
        'telp',
        'email',
        'saldo_akhir',
    ];
}

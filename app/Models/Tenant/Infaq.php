<?php

namespace App\Models\Tenant;

use App\Traits\HasCreatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infaq extends Model
{
    use HasFactory;
    use HasCreatedBy;

    protected $guarded = [];

    public function kas()
    {
        return $this->hasOne(Kas::class);
    }


    public function masjid()
    {
        return $this->belongsTo(Masjid::class, 'id');
    }


    public function scopeSaldoAkhir($query)
    {
        $masjid = Masjid::first();
        return $masjid->saldo_akhir ?? 0;
    }

    public function scopeUserMasjid($query)
    {
        return $query->where('id', auth()->user()->id);
    }
}

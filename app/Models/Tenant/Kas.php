<?php

namespace App\Models\Tenant;

use App\Traits\HasCreatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kas extends Model
{
    use HasFactory;
    use HasCreatedBy;
    protected $table = 'kas';
    protected $fillable = [
        'tanggal',
        'kategori',
        'keterangan',
        'jenis',
        'jumlah',
        'saldo_akhir',
        'created_by',
    ];
    protected $casts = [
        'tanggal' => 'datetime:d-m-Y H:i',
    ];

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

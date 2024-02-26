<?php

namespace App\Models\Tenant;

use App\Traits\GenerateSlug;
use App\Traits\HasCreatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informasi extends Model
{
    use HasFactory;
    use HasCreatedBy, GenerateSlug;
    protected $casts = [
        'tanggal' => 'date',
    ];

    protected $contentName = 'konten';
    protected $guarded = [];
}

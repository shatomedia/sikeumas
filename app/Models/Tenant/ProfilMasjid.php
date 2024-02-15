<?php

namespace App\Models\Tenant;

use App\Traits\ConvertContentImageBase64ToUrl;
use App\Traits\GenerateSlug;
use App\Traits\HasCreatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilMasjid extends Model
{
    use HasFactory;
    use HasCreatedBy, GenerateSlug;
    use ConvertContentImageBase64ToUrl;

    protected $contentName = 'konten';
    protected $guarded = [];
}

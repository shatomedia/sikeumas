<?php

namespace App\Models;

use App\Traits\HasCreatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    use HasFactory;
    use HasCreatedBy;
    protected $fillable = [
        'category_id',
        'judul',
        'slug',
        'konten',
        'gambar',
        'created_by',
        'views',
        'status',
        'publish_date',
    ];

    public function CategoryArtikel(): BelongsTo
    {
        return $this->belongsTo(CategoryArticle::class, 'category_id');
    }

    protected $casts = [
        'publish_date' => 'datetime',
    ];
}

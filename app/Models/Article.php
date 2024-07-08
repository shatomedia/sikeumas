<?php

namespace App\Models;

use App\Traits\HasCreatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    use HasCreatedBy;
    protected $guraded = [];

    public function categoryArtikel()
    {
        return $this->belongsTo(CategoryArticle::class);
    }
}

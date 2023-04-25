<?php

namespace App\Models;

use App\Traits\UUIDAble;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory, UUIDAble;

    protected $table = 'posts';
    protected $fillable = [
        'uuid',
        'website_id',
        'title',
        'description',
    ];

    public function website(): BelongsTo
    {
        return $this->belongsTo(WebSite::class, 'website_id', 'id')->withDefault();
    }
}

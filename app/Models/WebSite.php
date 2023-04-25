<?php

namespace App\Models;

use App\Traits\UUIDAble;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WebSite extends Model
{
    use HasFactory, UUIDAble;

    protected $table = 'websites';

    protected $fillable = [
        'uuid',
        'name',
        'link'
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'website_id', 'id');
    }
}

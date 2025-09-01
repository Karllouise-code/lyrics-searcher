<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lyric extends Model
{
    protected $fillable = ['artist', 'title', 'lyrics'];

    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }
}
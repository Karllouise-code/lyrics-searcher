<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Favorite extends Model
{
    protected $fillable = ['user_id', 'lyric_id'];

    public function lyric(): BelongsTo
    {
        return $this->belongsTo(Lyric::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tweet extends Model
{
    protected $fillable = ['category_id', 'username', 'content'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}

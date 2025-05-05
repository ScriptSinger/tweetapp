<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{

    protected $fillable = ['category_id', 'username', 'content'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

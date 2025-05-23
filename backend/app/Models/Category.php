<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['title'];

    public function tweets()
    {
        return $this->hasMany(Tweet::class);
    }
}

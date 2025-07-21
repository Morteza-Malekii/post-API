<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'description',
        'author',
        'isComentOn'
    ];

    protected $casts = [
        'isComentOn' => 'boolean'
    ];
}

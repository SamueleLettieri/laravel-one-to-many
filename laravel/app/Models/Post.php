<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    //
    protected $fillable = [
        'author',
        'title',
        'post_content',
        'post_image',
        'post_date',
    ];

    use SoftDeletes;
}

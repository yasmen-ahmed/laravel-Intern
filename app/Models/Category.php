<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function posts()
    {
        // return $this->hasMany(Post::class,'category_id');
        return $this->belongsToMany(Post::class,'posts_categories','category_id','post_id');
    }
}

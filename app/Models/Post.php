<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'content', 'image', 'created_by'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'post_category');
    }
}

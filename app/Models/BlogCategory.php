<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    protected $guarded = [];
    public function blogs(){
        return $this->hasMany(Blog::class, 'category_id')->select('id', 'category_id', 'title', 'slug', 'image', 'status')->where('status', 1);
    }
}

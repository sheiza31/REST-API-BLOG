<?php

namespace App\Models;
use App\Models\Posts;
use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    protected $table = 'tags';
    protected $guarded = [];

     public function post()
     {
         return $this->belongsToMany(Posts::class, 'post_tags', 'category_id', 'post_id');
     }
}

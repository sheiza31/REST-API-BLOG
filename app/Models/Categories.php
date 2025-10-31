<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use app\Models\Posts;
class Categories extends Model
{
    protected $table = 'categories';
    protected $guarded = [];

   public function post()
     {
         return $this->belongsToMany(Posts::class, 'post_categories', 'category_id', 'post_id');
     }

    public function children() {
        return $this->hasMany(Categories::class, 'parent_id');
    }

    public function parent()  {
        return $this->belongsTo(Categories::class, 'parent_id');
    }
}

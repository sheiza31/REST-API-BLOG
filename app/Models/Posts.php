<?php

namespace App\Models;
use App\Models\Category;
use App\Models\Tags;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Posts extends Model 
{
    use SoftDeletes;
    protected $table = 'posts';
    protected $guarded = [];
   
    public function user()  {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsToMany(Category::class, 'post_categories', 'post_id', 'category_id');
    }

        public function tag()
    {
        return $this->belongsToMany(Tags::class, 'post_tags', 'post_id', 'category_id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Posts;
class Media extends Model
{
    protected $table = 'media';
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function post() {
        return $this->belongsTo(Posts::class);
    }
}

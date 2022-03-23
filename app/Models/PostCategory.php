<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    use HasFactory;

    protected $table = 'post_categories';

    public function posts() {
        return $this->hasMany(Post::class,'post_categories_id')
            ->orderBy('created_at', 'DESC');
    }

}

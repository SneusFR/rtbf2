<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'titleArt',
        'content'
    ];

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorite_post_user', 'post_id', 'user_id')->withTimestamps();
    }

}

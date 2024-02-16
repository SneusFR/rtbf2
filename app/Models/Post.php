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
        return $this->belongsToMany(User::class, 'favorites', 'post_id', 'user_id');
    }

    public function isFavoritedByUser($userId)
    {
        return $this->favoritedBy()->where('user_id', $userId)->exists();
    }

}

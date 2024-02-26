<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table='t_posts';

    protected $primaryKey='id_pos';

    protected $fillable = [
        'title_pos',
        'slug_pos',
        'title_pos',
        'hook_pos',
        'content_pos',
        'aut_pos',
        'cate_pos'
    ];

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 't_favorites', 'post_id_fav', 'user_id_fav');
    }

    public function isFavoritedByUser($userId)
    {
        return $this->favoritedBy()->where('user_id_fav', $userId)->exists();
    }

}

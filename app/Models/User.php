<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table='t_users';

    protected $primaryKey='id_user';


    protected $fillable = [
        'firstname_user',
        'name_user',
        'login',
        'email',
        'password',
        'adresse_user',
        'cp_user',
        'role_user',
        'ville_user',
        'tel_user',
        'date_naiss_user',
        'genre_user',
        'pref_user'
    ];

    public function favoritePosts()
    {
        return $this->belongsToMany(Post::class, 't_favorites', 'user_id_fav', 'post_id_fav');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


}

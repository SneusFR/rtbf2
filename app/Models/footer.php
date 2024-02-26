<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class footer extends Model
{
    use HasFactory;

    protected $table='t_footers';

    protected $fillable = [
        'title',
        'col',

    ];
}

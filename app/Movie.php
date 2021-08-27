<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'title',
        'tmdb_id',
        'watched_date',
        'poster_path',
        'release_date',
        'watched',
    ];
}

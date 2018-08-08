<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    //
    protected $fillable = [
        'title',
        'poster',
        'country_id',
        'realease_date',
        'director',
        'overview',
        'runtime',
        'imdb_score',
        'producer',
        'trailer',
    ];
    protected $guarded = [
        'id',
    ];
}

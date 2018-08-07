<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GenreMovie extends Model
{
    //
    protected $fillable = ['movie_id', 'genre_id'];

    public $timestamps = false;

    protected $table = 'genre_movie';

    public static  function scopeInsertGenreMovie($query, $genreId, $movieId)
    {
        $genreMovie['genre_id'] = $genreId;
        $genreMovie['movie_id'] = $movieId;

        return $query->insert(['genre_id' => $genreId, 'movie_id' => $movieId]);
    }
}

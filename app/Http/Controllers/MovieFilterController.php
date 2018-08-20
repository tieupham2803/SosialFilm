<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\GenreMovie;
use App\ActorMovie;
use App\Genre;
use App\Actor;
use App\Country;
use App\Review;
use DB;

class MovieFilterController extends Controller
{
    //
    public function search(Request $request)
    {
        $genre_id = $request->get('genre_id');
        $country_id = $request->get('country_id');
        if ($country_id&&$genre_id) {
            # code...
        $genre_movies = DB::table('genre_movie')->where('genre_id', '=', $genre_id)->join('movies', 'movie_id', '=','movies.id')->select('movies.*')->where('country_id', '=', $country_id);
        $movies =  $genre_movies->paginate(config('view.pagination-num-item-in-page'));
        } elseif($genre_id) {
        $genre_movies = DB::table('genre_movie')->where('genre_id', '=', $genre_id)->join('movies', 'movie_id', '=','movies.id')->select('movies.*');
        $movies =  $genre_movies->paginate(config('view.pagination-num-item-in-page'));
        } elseif ($country_id) {
        $mvsearch = DB::table('movies')->where('country_id', '=', $country_id);
        $movies =  $mvsearch->paginate(config('view.pagination-num-item-in-page'));
        }
        return view('filter', compact('movies'));
    }
}

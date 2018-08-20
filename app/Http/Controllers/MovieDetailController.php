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
use App\Repositories\Movie\MovieRepositoryInterface;

class MovieDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
        //
        $movies = Movie::paginate(config('view.pagination-num-item-in-page'));
        $genres = Genre::pluck('name', 'id');

        return view('filter', compact('movies', 'genres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $movies = Movie::findOrFail($id);
        $genres = DB::table('genre_movie')->where('movie_id', '=', $id)->join('genres', 'genre_id', '=','genres.id')->select('genres.name')->get();
        $actors = DB::table('actor_movie')->where('movie_id', '=', $id)->join('actors', 'actor_id', '=','actors.id')->select('actors.name', 'actors.avarta')->get();
        $reviews = DB::table('reviews')->where('movie_id', '=', $id)->select('id', 'title', 'created_at','content')->get();

        // var_dump($reviews);
        // exit();
        return view('moviedetails.show', compact('movies', 'genres', 'actors', 'reviews'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function searchByName(Request $request)
    {
        $students = Movie::where('title', 'like', '%' . $request->value . '%')->get();

        return response()->json($students);
    }

    // public function search(Request $request)
    // {

    //     $genres = Genre::pluck('name', 'id');
    //     $genre_id = $request->get('genre_id');


    //     $genre_movies = DB::table('genre_movie')->where('genre_id', '=', $genre_id)->join('movies', 'movie_id', '=','movies.id')->select('movies.*');
    //     $movies =  $genre_movies->paginate(config('view.pagination-num-item-in-page'));

    //     return view('filter', compact('movies', 'genres'));
    // }
}

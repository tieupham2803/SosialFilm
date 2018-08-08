<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Movie;
use App\Actor;
use App\Genre;
use App\GenreMovie;
use App\ActorMovie;
use App\Country;
use DB;
use App\Http\Requests\MovieFormRequest;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $movies = Movie::all();
        $genres = DB::table('genres')->join('genre_movie', 'genres.id', '=', 'genre_movie.genre_id')
        ->select('genres.*', 'genre_movie.movie_id')->get();
        $actors = DB::table('actors')->join('actor_movie', 'actors.id', '=', 'actor_movie.actor_id')
        ->select('actors.name', 'actor_movie.movie_id')->get();

        return view('backend.movies.list', compact('movies', 'genres', 'actors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $actors = Actor::pluck('name', 'id');
        $genre = Genre::pluck('name', 'id');
        $countries = Country::pluck('name', 'id');

        return view('backend.movies.add', compact('actors', 'genre', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MovieFormRequest $request)
    {
        //
        $data = $request->all();
        $genres = $request->get('genre_id');
        $actors = $request->get('actor_ids');
        $data['realease_date'] = Carbon::parse($request->realease_date);
        $data['title'] = $request->get('title');
        $data['country_id'] = $request->get('country_id');
        $data['director'] = $request->get('director');
        $data['overview'] = $request->get('overview');
        $data['runtime'] = $request->get('runtime');
        $data['trailer'] = $request->get('trailer');
        $data['imdb_score'] = $request->get('imdb_score');
        $slug = uniqid();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = $slug . '_' . $file->getClientOriginalName();
            $file->move(public_path() . '/images/movies/', $name);
            $data['poster'] = '/images/movies/' . $name;
            $imagePath = public_path() . '/images/movies/' . $name;
            Image::make($imagePath)->save();
        } else {
            $data['poster'] = 'null';
        }

        if (Movie::create($data)) {
            $newMovie = Movie::orderBy('id', 'desc')->take(1)->get();
            $movieId  = $newMovie[0]->id;
            foreach ($genres as $genreId) {
                $gen = GenreMovie::InsertGenreMovie($genreId, $movieId);
            }
            foreach ($actors as $actorId) {
                $act = ActorMovie::InsertActorMovie($actorId, $movieId);
            }

            return redirect()->route('movies.index')->with('success', trans('message.success-create'));
        } else {
            return back()->withErrors(trans('message.error'));
        }
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
}

<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\GenreRequest;
use App\Genre;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\GenreFormRequest;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
        $genres = Genre::all();

        return view('admin.genre_movie.list', compact('genres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
         return view('admin.genre_movie.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GenreFormRequest $request)
    {
        //
        // $genre = new Genre;
        $genre = Genre::create($request->all());
        $genre->save();

        return redirect('admin/genres')->with('success', trans('message.success-create'));
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
        try {
            $genre = Genre::findOrFail($id);

            return view('admin.genre_movie.edit', compact('genre'));
        } catch (ModelNotFoundException $e) {
            return $e->getMessage();
        }
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
        try {
            $genre = Genre::findOrFail($id);
            $genre->name = $request->name;
            $genre->save();

            return back()->with('success', trans('message.success-edit'));
        } catch (ModelNotFoundException $e) {
            return $e->getMessage();
        }
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
        $genre = Genre::findOrFail($id);
        $genre->delete();

        return back()->with('success', trans('message.genre-list'));
    }
}

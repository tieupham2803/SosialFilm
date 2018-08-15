<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Review;
use App\Movie;
use App\User;
use DB;

class ReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $reviews = DB::table('reviews')
        ->join('movies', 'reviews.movie_id', '=', 'movies.id')
        ->join('users', 'reviews.user_id', '=', 'users.id')
        ->select('reviews.*', 'movies.title AS moviesTitle', 'users.name AS author')
        ->get();

        return view('backend.reviews.list', compact('reviews'));
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
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect('/admin/reviews')->with('success', trans('message.success-delete'));
    }

    public function searchByName(Request $request)
    {
        $reviews  = Review::where('title', 'like', '%' . $request->value . '%')->get();

        return response()->json($reviews);
    }
}

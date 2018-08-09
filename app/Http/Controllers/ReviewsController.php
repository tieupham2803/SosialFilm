<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewFormRequest;
use Illuminate\Http\Request;
use App\Review;
use App\Movie;
use App\User;
use App\Like;
use Auth;
use DB;

class ReviewsController extends Controller
{
    public function index()
    {
        $loggedin_user = Auth::user()->id;
        $review_movie = DB::table('reviews')->join('movies', 'reviews.movie_id', '=', 'movies.id')
        ->select('reviews.*', 'movies.poster', 'movies.title AS moviesTitle')->where('reviews.user_id', '=', $loggedin_user);
        $reviews =  $review_movie->paginate(config('view.pagination-num-item-in-page'));

        return view('reviews.index', compact('reviews'));
    }

    public function create()
    {
        $movies = Movie::pluck('title', 'id');

        return view('reviews.create', compact('movies'));
    }

    public function store(ReviewFormRequest $request)
    {
        $data = $request->all();
        Review::create($data);
        $newReview = Review::orderBy('id', 'desc')->take(1)->get();

        return redirect()->route('reviews.show', $newReview[0]->id)->with('status', __('Your review has been created'));
    }

    public function show($id)
    {
        $review = Review::findOrFail($id);
        $movie = Movie::findOrFail($review->movie_id);
        $username = User::findOrFail($review->user_id)->name;
        if (Auth::user()) {
            $loggedInUser = Auth::user()->id;
            $like = Like::where('review_id', '=', $review->id)->count();
            $likeUser = Like::where(['user_id' => $loggedInUser, 'review_id' => $id])->first();

            return view('reviews.show', compact('review', 'movie', 'username', 'like', 'likeUser'));
        } else {
            $like = Like::where('review_id', '=', $review->id)->count();
            $likeUser = 0;

            return view('reviews.show', compact('review', 'movie', 'username', 'like', 'likeUser'));
        }
    }

    public function edit($id)
    {
        $review = Review::findOrFail($id);
        $movies = Movie::pluck('title', 'id');

        return view('reviews.edit', compact('review', 'id', 'movies'));
    }

    public function update(ReviewFormRequest $request, $id)
    {
        $data = $request->all();
        $review = Review::findOrFail($id);
        $review->update($data);

        return redirect()->route('reviews.edit', $review->id)->with('status', __('The review has been updated'));
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect('/reviews')->with('status', __('The review has been deleted'));
    }

    public function like($id)
    {
        $loggedInUser = Auth::user()->id;
        $likeUser = Like::liked($loggedInUser, $id);
        if (empty($likeUser->user_id)) {
            $userId = Auth::user()->id;
            $like1 = Like::create(['user_id' => $userId, 'review_id' => $id]);

            return redirect()->route('reviews.show', $id);
        } else {
            $likeUser->delete();

            return redirect()->route('reviews.show', $id);
        }
    }
}

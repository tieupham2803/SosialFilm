<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewFormRequest;
use Illuminate\Http\Request;
use App\Review;
use App\Movie;
use App\User;
use App\Like;
use Auth;

class ReviewsController extends Controller
{
    public function index()
    {
        $reviews = Review::paginate(config('view.pagination-num-item-in-page'));

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
        $movie = Movie::find($review->movie_id);
        $username = User::find($review->user_id)->name;
        $loggedin_user = Auth::user()->id;
        $like = Like::where('review_id', '=', $review->id)->count();
        $like_user = Like::where(['user_id' => $loggedin_user, 'review_id' => $id])->first();

        return view('reviews.show', compact('review', 'movie', 'username', 'like', 'like_user'));
    }

    public function edit($id)
    {
        $review = Review::findOrFail($id);

        return view('reviews.edit', compact('review', 'id'));
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
        $loggedin_user = Auth::user()->id;
        $like_user = Like::liked($loggedin_user, $id);
        if (empty($like_user->user_id)) {
            $user_id = Auth::user()->id;
            $like1 = Like::create(['user_id' => $user_id, 'review_id' => $id]);

            return redirect()->route('reviews.show', $id);
        } else {
            $like_user->delete();

            return redirect()->route('reviews.show', $id);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewFormRequest;
use Illuminate\Http\Request;
use App\Review;
use App\Movie;
use App\User;

class ReviewsController extends Controller
{
    public function index()
    {
        $reviews = Review::paginate(config('view.pagination-num-item-in-page'));

        return view('reviews.index', compact('reviews'));
    }

    public function create()
    {
        return view('reviews.create');
    }

    public function store(ReviewFormRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = 1;
        Review::create($data);
        $newReview = Review::orderBy('id', 'desc')->take(1)->get();

        return redirect()->route('reviews.show', $newReview[0]->id)->with('status', __('Your review has been created'));
    }

    public function show($id)
    {
        $review = Review::findOrFail($id);
        $movie = Movie::find($review->movie_id);
        $username = User::find($review->user_id)->name;

        return view('reviews.show', compact('review', 'movie', 'username'));
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
}

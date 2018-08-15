<?php

namespace App\Http\Controllers;

use App\Like;
use App\Movie;
use App\Review;
use Illuminate\Http\Request;
use DB;

class PagesController extends Controller
{
    public function welcome()
    {
        $movies = Movie::orderBy('created_at', 'desc')->take(9)->get();
        $arrMovies = json_decode(json_encode($movies), true);
//        Lay 3 review gan day nhat
        $reviews = DB::table('reviews')
            ->join('movies', 'reviews.movie_id', '=', 'movies.id')
            ->select('reviews.*', 'movies.poster')
            ->orderBy('reviews.created_at', 'desc')
            ->take(3)->get();
        foreach ($reviews as $review) {
            $like = Like::where('review_id', '=', $review->id)->count();
            $review->like = $like;
        }

//        Show ra cac review co thu tu nhieu like nhat
        $allReviews = DB::table('reviews')
            ->join('movies', 'reviews.movie_id', '=', 'movies.id')
            ->select('reviews.*', 'movies.poster')
            ->get();
        foreach ($allReviews as $review) {
            $like = Like::where('review_id', '=', $review->id)->count();
            $review->like = $like;
        }

        $sortReviews = json_decode(json_encode($allReviews), true);
        usort($sortReviews, function ($item1, $item2) {
            if ($item1['like'] == $item2['like']) {
                return 0;
            }

            return $item1['like'] < $item2['like'] ? 1 : -1;
        });

        return view('pages.home', compact('arrMovies', 'reviews', 'sortReviews', 'movies'));
    }

    public function ajaxLoadMore(Request $request)
    {
        $page = $request->get('page');
        $limit = 3;
        $start = ($page * $limit) - $limit;

        $results = DB::table('reviews')
            ->join('movies', 'reviews.movie_id', '=', 'movies.id')
            ->select('reviews.*', 'movies.poster')
            ->offset($start)
            ->limit($limit)
            ->get();
        foreach ($results as $review) {
            $like = Like::where('review_id', '=', $review->id)->count();
            $review->like = $like;
        }
        $arr = json_decode(json_encode($results), true);

        return $arr;
    }
}

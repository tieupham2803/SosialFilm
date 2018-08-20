<?php
namespace App\Repositories\Tour;

use Illuminate\Support\Facades\DB;
use App\User;
use App\GenreMovie;
use App\Repositories\EloquentRepository;
use Illuminate\Support\Facades\Redirect;
use App\Movie;

class TourEloquentRepository extends EloquentRepository implements TourRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Tour::class;
    }


    public function searchGenre($filters)
    {
        return GenreMovie::select('movie_id')->where('genre_id', $filters)->get();
        // var_dump($mv);
        // exit();

            // ->paginate(config('setting.perpage'));
    }
}

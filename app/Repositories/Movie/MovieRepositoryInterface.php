<?php
namespace App\Repositories\Tour;

use App\Movie;
use App\User;

interface TourRepositoryInterface
{

    public function searchGenre($filters);

}

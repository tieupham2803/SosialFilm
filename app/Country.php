<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //
    public static function scopegetCountry()
    {
    return Country::pluck('name', 'id');
    }
}

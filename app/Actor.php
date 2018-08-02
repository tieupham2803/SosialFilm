<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    protected $fillable = [
        'name',
        'avarta',
        'country_id',
        'birthday',
        'infor',
    ];
    protected $guarded = [
        'id',
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    //
    protected $fillable = ['user_id', 'review_id'];


    public function scopeUserlike($query)
    {
        return $query->where('active', 1);
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function review()
    {
        return $this->belongsTo('App\Review');
    }

    public function scopeLiked($query, $loggedinUser, $reviewId)
    {
        return $query->where([['user_id', '=', $loggedinUser], ['review_id', '=', $reviewId]])->first();
    }
}

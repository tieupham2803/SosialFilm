<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActorMovie extends Model
{

    protected $fillable = ['movie_id', 'actor_id'];
    public $timestamps = false;

    protected $table = 'actor_movie';

    public static function scopeInsertActorMovie($query, $actorId, $movieId)
    {
        $actorMovie['actor_id'] = $actorId;
        $actorMovie['movie_id'] = $movieId;

        return $query->insert(['actor_id' => $actorId, 'movie_id' => $movieId]);
    }
}

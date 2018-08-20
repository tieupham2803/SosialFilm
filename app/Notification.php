<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'from_user_id',
        'to_user_id',
        'type',
        'read',
        'click',
        'type_id',
    ];
}

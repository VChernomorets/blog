<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTime;

class Post extends Model
{
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function like(){
        return $this->hasMany('App\LikePost');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getCreatedAtAttribute($value){
        $data = new DateTime($value);
        return $data->format('Y-m-d');
    }
}

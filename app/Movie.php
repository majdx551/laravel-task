<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = ['title','cover','description','country'];

    public function genre()
    {
        return $this->hasMany(Genre::class,'movie_id','id');
    }

}

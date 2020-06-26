<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = ['name'];

    public function movie()
    {
        return $this->belongsTo(Genre::class,'movie_id','id');
    }
}

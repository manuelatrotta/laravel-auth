<?php

namespace App;

//use Faker\Generator as Faker;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
  protected $fillable = [
        'name'
    ];

    public function posts()
    {
        return $this->belongsToMany('App\Post');
    }
}

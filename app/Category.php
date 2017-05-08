<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;

    public function news()
    {
        return $this->morphedByMany('App\News', 'categoryable');
    }

    public function articles()
    {
        return $this->morphedByMany('App\Article', 'categoryable');
    }

    public function recipes()
    {
        return $this->morphedByMany('App\Recipe', 'categoryable');
    }


    public function getCategories(){
        return Category::all();
    }
}

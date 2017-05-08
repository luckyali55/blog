<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{

    protected $fillable = ['title', 'description'];

    public function categories()
    {
        return $this->morphToMany('App\Category', 'categoryable');
    }


    public function getRecipes($id = null){
        if(is_null($id))
            return Recipe::with('categories')->get()->sortByDesc('id');
        else
            return Recipe::with('categories')->findOrFail($id);
    }

    public function saveRecipe($input = null){
        if(!is_null($input) && is_array($input))
            return Recipe::create($input);
        else
            return null;
    }

    public function updateRecipe($input = [], $id = null, $cats = []){
        if(is_null($id) || empty($input)){
            return null;
        }else{

            Recipe::where('id', $id)->update($input);
            $news_db = Recipe::find($id);
            $news_db->categories()->sync($cats);
            return true;
        }
    }

    public function deleteRecipe($id){
        $news = Recipe::findOrFail($id);
        return $news->delete();
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Bouncer;

class News extends Model
{

    use SoftDeletes;

    protected $table = 'news';
    protected $fillable = ['title', 'description'];


    public function categories()
    {
        return $this->morphToMany('App\Category', 'categoryable');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }




    public function getNews($id = null){
        if(is_null($id))
            return News::with('categories')->get()->sortByDesc('id');
        else
            return News::with('categories')->findOrFail($id);
    }

    public function frontGetNews($id){
        return News::findOrFail($id);
    }

    public function saveNews($input = null){
        if(!is_null($input) && is_array($input))
            return News::create($input);
        else
            return null;
    }

    public function updateNews($input = [], $id = null, $cats = []){
        if(is_null($id) || empty($input)){
            return null;
        }else{

            News::where('id', $id)->update($input);
            $news_db = News::find($id);
            $news_db->categories()->sync($cats);
            return true;
        }
    }

    public function deleteNews($id){
        $news = News::findOrFail($id);
        return $news->delete();
    }

}

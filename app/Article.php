<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Bouncer;

class Article extends Model
{

    protected $fillable = ['title', 'description', 'user_id'];

    public function categories()
    {
        return $this->morphToMany('App\Category', 'categoryable');
    }

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }


    public function getArticles($id = null){

        if(is_null($id)) {

            if (isAdmin())
                return Article::with('categories')->get()->sortByDesc('id');
            elseif (isUser())
                return Article::where('user_id', Auth::user()->id)->with('categories')->get()->sortByDesc('id');
            else
                abort(401);

        }else{
            return Article::with('categories')->findOrFail($id);
        }

    }

    public function frontGetArticles(){
        return Article::with('user')->get()->sortByDesc('id');
    }

    public function getArticleWith($id, $with){
        return Article::with($with)->findOrFail($id);
    }

    public function frontGetArticle($id){
        return Article::with(['comments' => function ($q) {
            $q->orderBy('id', 'desc');
            $q->with('user');
        }])->with('user')->findOrFail($id);
    }

    public function saveArticle($input = null){
        if(!is_null($input) && is_array($input)){
            $input['user_id'] = Auth::user()->id;
            return Article::create($input);
        }else{
            return null;
        }

    }

    public function updateArticle($input = [], $id = null, $cats = []){
        if(is_null($id) || empty($input)){
            return null;
        }else{

            Article::where('id', $id)->update($input);
            $news_db = Article::find($id);
            $news_db->categories()->sync($cats);
            return true;
        }
    }

    public function deleteArticle($id){
        $article = Article::findOrFail($id);
        return $article->delete();
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Comment extends Model
{

    protected $fillable = ['comment', 'user_id', 'commentable_id', 'commentable_type'];

    public function commentable()
    {
        return $this->morphTo();
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function saveComment($data){
        $data['user_id'] = Auth::user()->id;
        $data['commentable_id'] = $data['article_id'];
        unset($data['article_id']);
        $data['commentable_type'] = 'App\Article';

        return Comment::create($data);
    }
}

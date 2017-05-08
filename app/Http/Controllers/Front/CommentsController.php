<?php

namespace App\Http\Controllers\Front;

use App\Article;
use App\Comment;
use Illuminate\Http\Request;

class CommentsController extends BaseController
{
    private $article;
    private $comment;

    public function __construct()
    {
        $this->article = new Article();
        $this->comment  = new Comment();
    }

    public function saveComment(Request $request){
        $this->validate($request, [
            'comment' => 'required|min:10',
        ]);

        $input  = $request->only('article_id', 'comment');
        $this->comment->saveComment($input);
        return redirect()->back();
    }
}

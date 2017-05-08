<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Bouncer;

class ArticlesController extends BaseController
{
    public $articles;
    public $categories;
    private $model;

    public function __construct()
    {
        $this->model = 'App\Article';
        $this->articles     = new Article();
        $this->categories   = new Category();

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        userCan('read', $this->model) ;
        $articles = $this->articles->getArticles();
        return view('articles.list', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        userCan('create', $this->model);
        $categories = $this->categories->getCategories();
        return view('articles.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        userCan('create', $this->model);
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required',
            'cats' => 'required',
        ]);

        $categories =   $request->only('cats');

        $input      =   $request->only('title', 'description');

        $save = $this->articles->saveArticle($input);
        if(is_null($save)){
            return redirect()->back()->with(['db_error' => 'Error occurred, please try again ']);
        }else{
            $save->categories()->sync($categories['cats']);
            return redirect(route('articles'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = $this->articles->getArticleWith($id, 'comments.user');
        dump($article);

        return view('articles.view', ['article' => $article]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        userCan('update', $this->model);
        $article       = $this->articles->getArticles($id) ;
        $categories = $this->categories->getCategories();
        $selected   = $article->categories->toArray();
        $selected_categories    =   [];
        foreach ($selected as $selected_category){
            $selected_categories[] = $selected_category['id'];
        }


        return view('articles.edit', ['article' => $article, 'id' => $id, 'categories' => $categories, 'selected' => $selected_categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        userCan('update', $this->model);
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required',
            'cats' => 'required',
        ]);

        $categories =   $request->only('cats');
        $input      =   $request->only('title', 'description');

        $save = $this->articles->updateArticle($input, $id, $categories['cats']);
        if(is_null($save)){
            return redirect()->back()->with(['db_error' => 'Error occurred, please try again ']);
        }else{
            return redirect(route('articles'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        userCan('delete', $this->model);
        $del = $this->articles->deleteArticle($id);
        if($del)
            return redirect(route('articles'))->with(['del_success' => 'Article deleted successfully.']);
        else
            return redirect(route('articles'))->with(['del_error' => 'Error in deleting article.']);

    }
}

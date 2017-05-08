<?php

namespace App\Http\Controllers\Front;

use App\Category;
use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends BaseController
{
    public $news;
    public $categories;
    private $model;

    public function __construct()
    {
        $this->model = 'App\News';
        $this->news     = new News();
        $this->categories = new Category();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        userCan('read', $this->model);

        $news = $this->news->getNews();

        return view('front.news.newslist', ['news' => $news]);
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
        return view('news.create', ['categories' => $categories]);
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

        $save = $this->news->saveNews($input);
        if(is_null($save)){
            return redirect()->back()->with(['db_error' => 'Error occurred, please try again ']);
        }else{
            $save->categories()->sync($categories['cats']);
            return redirect(route('news'));
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
        $news = $this->news->frontGetNews($id);
        return view('front.news.news', ['news' => $news]);
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

        $news       = $this->news->getNews($id) ;
        $categories = $this->categories->getCategories();
        $selected   = $news->categories->toArray();
        $selected_categories    =   [];
        foreach ($selected as $selected_category){
            $selected_categories[] = $selected_category['id'];
        }


        return view('news.edit', ['news' => $news, 'id' => $id, 'categories' => $categories, 'selected' => $selected_categories]);
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

        $save = $this->news->updateNews($input, $id, $categories['cats']);
        if(is_null($save)){
            return redirect()->back()->with(['db_error' => 'Error occurred, please try again ']);
        }else{
            return redirect(route('news'));
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

        $del = $this->news->deleteNews($id);
        if($del)
            return redirect(route('news'))->with(['del_success' => 'News deleted successfully.']);
        else
            return redirect(route('news'))->with(['del_error' => 'Error in deleting news.']);

    }
}

<?php

namespace App\Http\Controllers\Front;

use App\Recipe;
use Illuminate\Http\Request;
use App\Category;

class RecipesController extends BaseController
{
    public $recipes;
    public $categories;
    private $model;

    public function __construct()
    {
        $this->model = 'App\Recipe';
        $this->recipes      = new Recipe();
        $this->categories   = new Category();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        userCan('read', $this->model);
        $recipes = $this->recipes->getRecipes();
        return view('front.recipes.recipes', ['recipes' => $recipes]);
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
        return view('recipes.create', ['categories' => $categories]);
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

        $save = $this->recipes->saveRecipe($input);
        if(is_null($save)){
            return redirect()->back()->with(['db_error' => 'Error occurred, please try again ']);
        }else{
            $save->categories()->sync($categories['cats']);
            return redirect('recipes');
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
        //
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
        $recipe       = $this->recipes->getRecipes($id) ;
        $categories = $this->categories->getCategories();
        $selected   = $recipe->categories->toArray();
        $selected_categories    =   [];
        foreach ($selected as $selected_category){
            $selected_categories[] = $selected_category['id'];
        }


        return view('recipes.edit', ['recipe' => $recipe, 'id' => $id, 'categories' => $categories, 'selected' => $selected_categories]);
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

        $save = $this->recipes->updateRecipe($input, $id, $categories['cats']);
        if(is_null($save)){
            return redirect()->back()->with(['db_error' => 'Error occurred, please try again ']);
        }else{
            return redirect('recipes');
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
        $del = $this->recipes->deleteRecipe($id);
        if($del)
            return redirect('recipes')->with(['del_success' => 'Recipe deleted successfully.']);
        else
            return redirect('recipes')->with(['del_error' => 'Error in deleting recipe.']);

    }
}

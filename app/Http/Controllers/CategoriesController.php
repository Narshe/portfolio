<?php

namespace App\Http\Controllers;

use App\Category;

use Illuminate\Http\Request;
use App\Http\Requests\CategoriesRequest;
use Illuminate\Validation\Rule;

class CategoriesController extends AdminController
{
    /**
     * [index]
     * @return View admin.Categories.index
     */
    public function index()
    {
        $categories = Category::all();


        return view('Admin.Categories.index', compact('categories'));
    }

    /**
     * [create]
     * @return View admin.Categories.create
     */
    public function create()
    {
        $category = new Category();

        return view('Admin.Categories.create', compact('category'));
    }

    /**
     * [store]
     * @param  CategoriesRequest $request
     * @return Redirect to Categories
     */
    public function store(CategoriesRequest $request)
    {
        Category::create($request->all());

        return redirect()->route('Categories')->with('success', 'Cette catégorie a bien été ajouté');
    }

    /**
     * [edit]
     * @param  Category $category [description]
     * @return View Admin.Categories.edit
     */
    public function edit(Category $category)
    {
        return view('Admin.Categories.edit', compact('category'));
    }

    /**
     * [update]
     * @param  Category          $category
     * @param  CategoriesRequest $request
     * @return Redirect to Categories
     */
    public function update(Category $category, CategoriesRequest $request)
    {
        $category->update($request->all());

        return redirect()->route('Categories')->with('success', 'Cette catégorie a bien été édité');
    }

    /**
     * [destroy]
     * @param  Category $category
     * @return Redirect to Categories
     */
    public function destroy(Category $category)
    {
        //Ajoute un event
        $relation = substr(strtolower(str_plural($category->type)),4);

        if($category->$relation)
        $category->$relation->each->delete();

        $category->delete();

        return redirect()->route('Categories')->with('success', 'Cette catégorie a bien été supprimé');
    }
}

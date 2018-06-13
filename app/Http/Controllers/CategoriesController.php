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
     * @return View Admin/Categories/index.blade.php
     */
    public function index()
    {
        $categories = Category::all();

        return view('Admin.Categories.index', compact('categories'));
    }

    /**
     * [create]
     * @return View Admin/Categories/create.blade.php
     */
    public function create()
    {
        $category = new Category();

        return view('Admin.Categories.create', compact('category'));
    }

    /**
     * [store]
     * @param  CategoriesRequest $request
     * @return Redirect to categories/index
     */
    public function store(CategoriesRequest $request)
    {
        Category::create($request->all());

        return redirect()->route('Categories')->with('success', 'Cette catégorie a bien été ajouté');
    }

    /**
     * [edit]
     * @param  Category $category [description]
     * @return View Admin/Categories/edit.blade.php
     */
    public function edit(Category $category)
    {
        return view('Admin.Categories.edit', compact('category'));
    }

    /**
     * [update]
     * @param  Category          $category
     * @param  CategoriesRequest $request
     * @return Redirect to categories/index
     */
    public function update(Category $category, CategoriesRequest $request)
    {
        $category->update($request->all());

        return redirect()->route('Categories')->with('success', 'Cette catégorie a bien été édité');
    }

    /**
     * [destroy]
     * @param  Category $category
     * @return Redirect to categories/index
     */
    public function destroy(Category $category)
    {

        $category->delete();

        return redirect()->route('Categories')->with('success', 'Cette catégorie a bien été supprimé');
    }
}

<?php

namespace App\Http\Controllers;

use App\Category;

use Illuminate\Http\Request;
use App\Http\Requests\CategoriesRequest;
use Illuminate\Validation\Rule;

class CategoriesController extends AdminController
{
    public function index()
    {
        $categories = Category::all();

        return view('Admin.Categories.index', compact('categories'));
    }

    public function create()
    {
        $category = new Category();

        return view('Admin.Categories.create', compact('category'));
    }

    public function store(CategoriesRequest $request)
    {
        $category = new Category();

        if ($category->create($request->all())) {
            return redirect()->route('Categories')->with('success', 'Cette catégorie a bien été ajouté');
        } else {
            return view('Admin.Categories.create', compact('category'))->withErrors();
        }
    }

    public function edit(Category $category)
    {
        return view('Admin.Categories.edit', compact('category'));
    }

    public function update(Category $category, CategoriesRequest $request)
    {
    
        if ($category->update($request->all())) {
            return redirect()->route('Categories')->with('success', 'Cette catégorie a bien été édité');
        } else {
            return view('Admin.Categories.edit', compact('category'))->withErrors();
        }
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('Categories')->with('success', 'Cette catégorie a bien été supprimé');
    }
}

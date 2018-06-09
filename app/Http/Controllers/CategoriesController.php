<?php

namespace App\Http\Controllers;

use App\Category;

use Illuminate\Http\Request;
use App\Http\Requests\CategoriesRequest;

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
        $params = $request->all();
        $category = new Category();
        if ($category->create($params)) {
            return redirect()->route('Categories')->with('success', 'Cette catégorie a bien été ajouté');
        } else {
            return view('Admin.Categories.create', compact('category'))->withErrors();
        }
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('Admin.Categories.edit', compact('category'));
    }

    public function update($id, CategoriesRequest $request)
    {
        $category = Category::findOrFail($id);

        if ($category->update($request->all())) {
            return redirect()->route('Categories')->with('success', 'Cette catégorie a bien été édité');
        } else {
            return view('Admin.Categories.edit', compact('category'))->withErrors();
        }
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('Categories')->with('success', 'Cette catégorie a bien été supprimé');
    }
}

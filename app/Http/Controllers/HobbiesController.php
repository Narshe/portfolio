<?php

namespace App\Http\Controllers;

use App\Hobby;
use App\Category;
use App\Media;
use App\Http\Requests\HobbiesRequest;

class HobbiesController extends AdminController
{
    public function index()
    {
        $hobbies = Hobby::all();


        return view('Admin.Hobbies.index', compact('hobbies'));
    }

    public function create()
    {
        $hobby = new Hobby();
        $hobbyCategories = Category::where('type', 'Hobby')->get();

        return view('Admin.Hobbies.create', compact('hobby', 'hobbyCategories'));
    }

    public function store(HobbiesRequest $request)
    {

        $hobby = new Hobby();
        $params = $request->all();

        $params['visible'] = (isset($params['visible'])) ? 1 : 0;

        if ($hobby = $hobby->create($params)) {

            if (isset($params['media'])) {

                $media = new Media();
                $media->uploadFile($params['media'], 'logos/hobbies');
                $media->mediable_id = $hobby->id;
                $media->mediable_type = Hobby::class;
                $media->type = "logo";
                $media->alt = $params['name'].'-'.$media->type;
                $media->save();
            }

            return redirect()->route('Hobbies')->with('success', 'Ce hobby a bien été ajouté');
        } else {
            $hobbyCategories = Category::where('type', 'Hobby')->get();
            return view('Admin.Hobbies.create', compact('hobby','hobbyCategories'))->withErrors();
        }
    }

    public function edit($id)
    {
        $hobby = Hobby::findOrFail($id);
        $hobbyCategories = Category::where('type', 'Hobby')->get();
        return view('Admin.Hobbies.edit', compact('hobby', 'hobbyCategories'));
    }

    public function update($id, HobbiesRequest $request)
    {
        $hobby = Hobby::findOrFail($id);
        $params = $request->all();
        $params['visible'] = (isset($params['visible'])) ? 1 : 0;

        if ($hobby->update($params)) {

            if (isset($params['media'])) {

                $media = new Media();
                $media->uploadFile($params['media'], 'logos/hobbies');
                $media->mediable_id = $hobby->id;
                $media->mediable_type = Hobby::class;
                $media->type = "logo";
                $media->alt = $params['name'].'-'.$media->type;
                $media->save();
            }

            return redirect()->route('Hobbies')->with('success', 'Ce hobby a bien été modifié');
        } else {
            $hobbyCategories = Category::where('type', 'Hobby')->get();
            return view('Admin.Hobbies.edit', compact('hobby','hobbyCategories'))->withErrors();
        }
    }

    public function destroy($id)
    {
        $hobby = Hobby::findOrFail($id);
        $hobby->delete();
        return redirect()->route('Hobbies')->with('success', 'Ce hobby a bien été supprimé');
    }
}

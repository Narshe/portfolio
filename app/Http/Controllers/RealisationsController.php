<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Realisation;
use App\Skill;
use App\Media;
use App\SkillCategory;
use App\Category;

use App\Http\Requests\RealisationRequest;

class RealisationsController extends AdminController
{
    public function index()
    {
        $realisations = Realisation::all();

        return view('Admin.Realisations.index', compact('realisations'));
    }

    /**
     * [show description]
     * @param  int    $id [description]
     * @return [type]     [description]
     */
    public function show(int $id)
    {
        $realisation = Realisation::findOrFail($id);

        return view('Admin.Realisations.show', compact('realisation'));
    }

    public function create()
    {
        $realisation = new Realisation();
        $skills = Skill::with('Category')->get();
        $experiencesCategories = Category::where('type', 'Experience')->get();

        $skillsGrouped = $skills->groupBy(function ($item, $key) {
            return $item->category->name;
        });

        return view('Admin.Realisations.create', compact('realisation', 'skills', 'skillsGrouped', 'experiencesCategories'));
    }

    public function store(RealisationRequest $request)
    {
        $realisation = new Realisation();
        $params = $request->all();

        $params['visible'] = (isset($params['visible'])) ? 1 : 0;

        if ($realisation = $realisation->create($params)) {

            $realisation->skills()->sync($params['skills']);
            if (isset($params['files'])) {

                $dirname = 'pictures/realisations/'.$realisation->id;

                foreach ($params['files'] as $key => $file) {

                    $media = new Media();
                    $media->uploadFile($file, $dirname);
                    $media->type = "photo";
                    $media->mediable_id = $realisation->id;
                    $media->mediable_type = Realisation::class;
                    $media->alt = $realisation->name . '-' . ($key+1) . '-' . $media->type;
                    $media->save();
                }
            }

            return redirect()->route('Realisations')->with('success', 'Cette réalisation a bien été ajouté');
        } else {
            $skills = Skill::with('SkillCategory')->get();
            $skillsGrouped = $skills->groupBy(function ($item, $key) {
                return $item->SkillCategory->name;
            });

            return view('Admin.Realisations.create', compact('skillsGrouped', 'realisation'))->withErrors();
        }
    }

    /**
     * [edit description]
     * @param  int    $id [description]
     * @return [type]     [description]
     */
    public function edit(int $id)
    {
        $realisation = Realisation::findOrFail($id);
        $experiencesCategories = Category::where('type', 'Experience')->get();
        $skills = Skill::with('Category')->get();

        $skillsGrouped = $skills->groupBy(function ($item, $key) {
            return $item->category->name;
        });

        //  dd($skillsGrouped);

        return view('Admin.Realisations.edit', compact('realisation', 'skillsGrouped', 'experiencesCategories'));
    }

    /**
     * [update description]
     * @param  int                $id      [description]
     * @param  RealisationRequest $request [description]
     * @return [type]                      [description]
     */
    public function update(int $id, RealisationRequest $request)
    {
        $realisation = Realisation::findOrFail($id);
        $params = $request->all();

        $params['visible'] = (isset($params['visible'])) ? 1 : 0;

    //    dd($params);
        if ($realisation->update($params)) {
        //    dd($params);
        //    Mettre un event
            $realisation->skills()->sync($params['skills']);
            if (isset($params['files'])) {

                $dirname = 'pictures/realisations/'.$realisation->id;

                foreach ($params['files'] as $key => $file) {

                    $media = new Media();
                    $media->uploadFile($file, $dirname);
                    $media->type = "photo";
                    $media->mediable_id = $realisation->id;
                    $media->mediable_type = Realisation::class;
                    $media->alt = $realisation->name . '-' . ($key+1) . '-' . $media->type;
                    $media->save();
                }
            }

            return redirect()->route('Realisations')->with('success', 'Cette réalisation a bien été modifié');

        } else {
            $skills = Skill::with('SkillCategory')->get();
            $skillsGrouped = $skills->groupBy(function ($item, $key) {
                return $item->SkillCategory->name;
            });

            return view('Admin.Realisations.edit', compact('skillsGrouped'))->withErrors();
        }
    }

    public function destroy($id)
    {
        $realisation = Realisation::findOrFail($id);
        $realisation->delete();

        return redirect()->route('Realisations')->with('success', 'Cette réalisation a bien été supprimé');
    }


}

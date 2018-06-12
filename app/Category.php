<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;

    protected $fillable = ['name', 'type'];

    protected static function boot()
    {
        parent::boot();


        static::deleting(function($category) {


            if($relation = $category->getRelation($category)) {

                $category->$relation->each->delete();
            }
        });
    }


    public function visibleSkills()
    {
        return $this->hasMany('App\Skill')->whereVisible(true);
    }

    public function skills()
    {
        return $this->hasMany('App\Skill');
    }

    public function visibleRealisations()
    {
        return $this->hasMany('App\Realisation')->whereVisible(true);
    }

    public function realisations()
    {
        return $this->hasMany('App\Realisation');
    }

    public function visibleHobbies()
    {
        return $this->hasMany('App\Hobby')->whereVisible(true);
    }

    public function hobbies()
    {
        return $this->hasMany('App\Hobby');
    }

    public function getIcons()
    {
        $icons = ['jeux videos' => 'gamepad', 'cinéma' => 'film', 'informatique' => 'terminal'];

        return isset($icons[strtolower($this->name)]) ? $icons[strtolower($this->name)] : '';
    }

    public function getRelation($category)
    {
        return strtolower(str_plural(explode('\\', $category->type)[1]));
    }

    /**
     * [Get the categories with the data associated according to the model type]
     * @param  String $has
     * @param  Array  $with
     * @param  String $model
     * @return Collection|[]
     */
    public static function getCategories($has, $with, $model)
    {
        return self::has($has)->with($with)->where('type', $model)->get();
    }
}

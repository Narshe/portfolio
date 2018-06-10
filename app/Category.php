<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;

    protected $fillable = ['name', 'type'];


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

    /**
     * [Get the categories with the data associated according to the model type]
     * @param  Array  $with
     * @param  String $model
     * @return Collection|null
     */
    public static function getCategories($with, $model)
    {
        return self::with($with)->where('type', $model)->get() ?: null;
    }
}

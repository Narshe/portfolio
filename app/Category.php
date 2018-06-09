<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;

    protected $fillable = ['name', 'type'];

    public function skills()
    {
        return $this->hasMany('App\Skill');
    }

    public function realisations()
    {
        return $this->hasMany('App\Realisation');
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
}

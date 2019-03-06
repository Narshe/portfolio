<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Observers\SkillObserver;

//use App\Events\UpdateMedia;

class Skill extends Model
{
    protected $fillable = ['name', 'url', 'description', 'category_id', 'level_id', 'visible', 'path'];

    protected $casts = [
       'visible' => 'boolean'
    ];

    public function realisations()
    {
        return $this->belongsToMany('App\Realisation', 'realisation_skill');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function level()
    {
        return $this->belongsTo('App\Level');
    }

    public function scopeVisible($query)
    {
        return $query->where('visible', 1);
    }

    public function getDescriptions()
    {
        return $this->description ? explode(',', trim($this->description)) : [];
    }


    public function setVisibleAttribute($value)
    {
        $this->attributes['visible'] = $value;
    }

    public static function getVisibleSkills()
    {

        return Category::getCategories(
            'skills',
            ['skills.level'],
            Skill::class
        );
    }
}

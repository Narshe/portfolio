<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Observers\SkillObserver;

use App\Category;
use App\Media;
use App\Events\UpdateMedia;

class Skill extends Model
{
    protected $fillable = ['name', 'url', 'description', 'category_id', 'level_id', 'visible'];

    protected $casts = ['visible' => 'boolean'];


    public function realisations()
    {
        return $this->belongsToMany('App\Realisation', 'realisation_skill');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function media()
    {
        return $this->morphOne('App\Media', 'mediable');
    }

    public function level()
    {
        return $this->belongsTo('App\Level');
    }

    public function getDescriptionAttribute($value)
    {
        return $value ? explode(',', trim($value)) : false;
    }

    public function setVisibleAttribute($value)
    {
        $this->attributes['visible'] = !! $value;
    }

    public function updateSkill()
    {
        if (request()->has('media')) {
            event(new UpdateMedia($this));
        }

        $this->update(request()->all());
    }

    public static function getVisibleSkills()
    {
        return Category::getCategories(
            'visibleSkills',
            ['visibleSkills.level','visibleSkills.media'],
            Skill::class
        );
    }
}

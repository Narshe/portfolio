<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Observers\SkillObserver;

use App\Category;

class Skill extends Model
{
    protected $fillable = ['name', 'url', 'description', 'category_id', 'level_id', 'visible'];

    //  protected $events = ['creating' => SkillObserver::class, 'deleting' => SkillObserver::class];

    public function cat()
    {
        return $this->morphToMany(Category::class, 'categorizable');
    }

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

    public static function getVisibleSkills()
    {
        return Category::getCategories(
            'visibleSkills',
            ['visibleSkills.level','visibleSkills.media'],
            Skill::class
        );
    }
}

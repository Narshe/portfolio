<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Observers\SkillObserver;

use App\Events\UpdateMedia;

class Skill extends Model
{
    protected $fillable = ['name', 'url', 'description', 'category_id', 'level_id', 'visible'];

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

    public function getDescriptions()
    {
        return $this->description ? explode(',', trim($this->description)) : [];
    }


    public function uploadFile()
    {
        $media = new Media();

        $media->create([
            'mediable_type' => Skill::class,
            'mediable_id'   => $this->id,
            'type' => 'logo',
            'alt'  => request('name'). '-' . 'logo',
            'path' => $media->storeFile(request('media'), 'logos/skills')
        ]);
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

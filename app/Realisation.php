<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Realisation extends Model
{
    protected $fillable = ['name', 'company', 'date_begin', 'date_end', 'visible', 'url', 'position', 'category_id'];

    protected $dates = [
        'date_begin',
        'date_end'
    ];

    public function medias()
    {
        return $this->morphMany('App\Media', 'mediable');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function skills()
    {
        return $this->belongsToMany('App\Skill');
    }

    public function setDateBeginAttribute($value)
    {
        $this->attributes['date_begin'] = new \DateTime($value);
    }

    public function setDateEndAttribute($value)
    {
        $this->attributes['date_end'] = new \DateTime($value);
    }

    public function getCoverAttribute() {

        foreach ($this->medias as $media) {

            if ($media->type ==  'cover') {
                return $media;
            }
        }
    }
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Realisation extends Model
{
    protected $fillable = ['name', 'company', 'date_begin', 'date_end', 'visible', 'url', 'position', 'category_id'];

    protected $dates = [
        'date_begin',
        'date_end'
    ];

    protected $casts = [
       'visible' => 'boolean'
    ];

    public function medias()
    {
        return $this->morphMany('App\Media', 'mediable')->latest('cover');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function skills()
    {
        return $this->belongsToMany('App\Skill');
    }

    public function scopeVisible($query)
    {
        return $query->where('visible', 1);
    }

    public function updateRealisation()
    {
        if (request()->has('files')) {

            $this->storeFiles($this);
        }

        $this->attributes['visible'] = request()->has('visible');

        $this->update(request()->except('visible'));
    }

    public function storeFiles()
    {
        $dirname = "pictures/realisations/{$this->id}";

        foreach (request('files') as $file) {

            $media = new Media();
            $media->create([
                'mediable_type' => Realisation::class,
                'mediable_id'   => $this->id,
                'type' => 'photo',
                'alt'  =>  "{$this->name}-realisation",
                'path' =>  $media->storeFile($file, $dirname)
            ]);
        }
    }


    public function getDateBeginAttribute($value)
    {
        return new \Datetime($value);
    }

    public function getDateEndAttribute($value)
    {
        return new \Datetime($value);
    }
    //
    // public function getCoverAttribute() {
    //
    //
    //     $cover = $this->medias->first(function($media) {
    //         return $media->cover;
    //     });
    //
    //     return $cover ?: $this->medias[0];
    //
    // }

    public static function getVisibleRealisations()
    {
         return Category::getCategories(
             'realisations',
             ['realisations.medias','realisations.skills'],
              Realisation::class
         );


    }
}

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

    public function updateRealisation()
    {
        if (request()->has('files')) {

            $this->storeFiles($this);
        }

        $this->skills()->sync(request('skills'));

        $this->update(request()->all());
    }

    public function storeFiles()
    {
        $dirname = 'pictures/realisations/'.$this->id;

        foreach (request('files') as $file) {

            $media = new Media();
            $media->create([
                'mediable_type' => Realisation::class,
                'mediable_id'   => $this->id,
                'type' => 'photo',
                'alt'  =>  "{$this->name}-realisation",
                'path' =>  $media->uploadFile($file, $dirname)
            ]);
        }
    }
    public function setVisibleAttribute($value)
    {
        $this->attributes['visible'] = !! $value;
    }

    public function getDateBeginAttribute($value)
    {
        return new \Datetime($value);

        // $this->attributes['date_begin'] = new \DateTime($value);
    }

    public function getDateEndAttribute($value)
    {
        return new \Datetime($value);
        // $this->attributes['date_end'] = new \DateTime($value);
    }

    public function getCoverAttribute() {

        foreach ($this->medias as $media) {

            if ($media->type ==  'cover') {
                return $media;
            }
        }
    }

    public static function getVisibleRealisations()
    {
         return Category::getCategories(
             'visibleRealisations',
             ['visibleRealisations.medias','visibleRealisations.skills'],
              Realisation::class
         );


    }
}

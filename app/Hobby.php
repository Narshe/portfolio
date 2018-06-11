<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Category;

class Hobby extends Model
{
    public $timestamps = false;

    protected $fillable = ['name', 'url', 'category_id', 'visible'];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function media()
    {
        return $this->morphOne('App\Media', 'mediable');
    }

    public static function getVisibleHobbies()
    {
        return Category::getCategories(
            'visibleHobbies',
            ['visibleHobbies.media'],
             Hobby::class
        );
    }
}

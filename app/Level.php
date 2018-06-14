<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    public $timestamps = false;

    protected $fillable = ['name', 'value'];

    
    public function skills()
    {
        return $this->hasMany('App\Skill');
    }

    public static function get()
    {
        return self::where('value', '>', 0)->orderBy('value', 'ASC')->get();
    }
}

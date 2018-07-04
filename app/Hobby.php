<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Hobby extends Model
{
    public $timestamps = false;

    protected $fillable = ['name', 'url', 'visible', 'description', 'icon'];


    public function getDescription()
    {
        return explode(',', $this->description);
    }

    public function scopeVisible($query)
    {
        return $query->where('visible', 1);
    }


}

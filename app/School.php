<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    public $timestamps = false;

    protected $dates = [
        'date_begin',
        'date_end'
    ];

    protected $fillable = ['name', 'city', 'description', 'date_begin', 'date_end', 'url'];

    public static function get()
    {
         return self::orderBy('date_begin', 'DESC')->get();
    }
}

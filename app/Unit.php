<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = ['name', 'address'];

    /**
    * Get all unit list.
    *
    * @return  array unit list
    */
    public static function getArray()
    {
        $units = Unit::orderBy('id','ASC')->get();
        $options = array();

        foreach ($units as $unit) {
            $options[$unit->id] = $unit->name;
        }

        return $options;
    }
}

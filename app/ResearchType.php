<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResearchType extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];
}

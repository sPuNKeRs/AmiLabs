<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Analysis extends Model
{
    protected $fillable = [
        'name',
        'unit',
        'r_range',
        'research_id'
    ];
}

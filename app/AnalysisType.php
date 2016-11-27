<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnalysisType extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];
}

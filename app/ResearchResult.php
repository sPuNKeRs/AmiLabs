<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResearchResult extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
    */
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'patient_researh_id',
        'analysis_id',
        'result',
        'pay'
    ];

    // Связь с исследованием
    public function patient_researh()
    {
        return $this->belongsTo('App\PatientResearh');
    }

    // Связь с анализом
    public function analysis()
    {
        return $this->hasOne('App\Analysis', 'id', 'analysis_id');
    }
}

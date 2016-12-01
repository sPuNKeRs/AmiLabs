<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResearchResult extends Model
{
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

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientResearh extends Model
{
    protected $fillable = [
        'patient_id',
        'research_id',
        'create_date',
        'status'
    ];
}

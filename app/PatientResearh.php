<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PatientResearh extends Model
{
    protected $fillable = [
        'patient_id',
        'research_id',
        'create_date',
        'status'
    ];

    /**
    * Конвертация даты при сохранении
    */
    public function setCreateDateAttribute($date)
    {
        $this->attributes['create_date'] = Carbon::createFromFormat('d.m.Y',$date);
    }

    /**
     * Конвертация даты при получении
     */
    public function getCreateDateAttribute($date)
    {
        return date('d.m.Y', strtotime($date));
    }

    // Получить описание исследования
    public function research()
    {
        return $this->hasOne('App\Research', 'id', 'research_id');
    }

    // Получить пациента
    public function patient()
    {
        return $this->hasOne('App\Patient', 'id', 'patient_id');
    }
}

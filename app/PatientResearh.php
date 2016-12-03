<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatientResearh extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
    */
    protected $dates = ['deleted_at'];

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
        return $this->belongsTo('App\Patient');
    }

    // Получить результаты
    public function results()
    {
        return $this->hasMany('App\ResearchResult');
        //return $this->belongsToMany('App\ResearchResult', 'research_results', 'research_id', 'analysis_id');
    }
}

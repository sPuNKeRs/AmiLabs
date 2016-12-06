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
        'status',
        'issue_date',
        'comment'
    ];

    /**
    * Конвертация даты при сохранении
    */
    public function setCreateDateAttribute($date)
    {
        if($date == null){
            $this->attributes['create_date'] = null;
        }else{
            $this->attributes['create_date'] = Carbon::createFromFormat('d.m.Y',$date);
        }
    }

    public function setIssueDateAttribute($date)
    {
        if($date == null){
            $this->attributes['issue_date'] = null;
        }else{
            $this->attributes['issue_date'] = Carbon::createFromFormat('d.m.Y',$date);
        }
    }

    /**
     * Конвертация даты при получении
     */
    public function getCreateDateAttribute($date)
    {
        if($date == null) return null;
        return date('d.m.Y', strtotime($date));
    }

    public function getIssueDateAttribute($date)
    {
        if($date == null) return null;
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
    }
}

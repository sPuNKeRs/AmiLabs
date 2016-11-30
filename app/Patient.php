<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
    	    'card_number',
            'card_date',
            'surname',
            'firstname',
            'lastname',
            'gender',
            'birth_date',
            'address',
            'phone',
            'email',
            'more_inform',
            'author_id'
    ];


    /**
     * Получить последний следующий ID
     */
    public static function getNextId()
    {
        if($next = static::orderBy('id', 'desc')->first())
        {
            return $next->id+1;
        }
        return 1;
    }

    /**
     * Получить ФИО пациента
     */
    public function getFio($upper = false)
    {
        $surname = (isset($this->surname)) ? $this->surname : '';
        $firstname = (isset($this->firstname)) ? $this->firstname : '';
        $lastname = (isset($this->lastname)) ? $this->lastname : '';

        $fio = $surname.' '.$firstname.' '.$lastname;

        if($upper == true)
        {
            $fio = mb_strtoupper($fio);
        }

        return $fio;
    }

    /**
     * Конвертация даты создания карты при сохранении
     */
    public function setCardDateAttribute($date)
    {
        $this->attributes['card_date'] = Carbon::createFromFormat('d.m.Y',$date);
    }

     /**
     * Конвертация даты создания карты при сохранении
     */
    public function setBirthDateAttribute($date)
    {
        $this->attributes['birth_date'] = Carbon::createFromFormat('d.m.Y',$date);
    }

    /**
     * Конвертация даты создания карты при выборке
     */
    public function getCardDateAttribute($date)
    {
        return date('d.m.Y', strtotime($date));
    }

    /**
     * Конвертация даты рождения при выборке
     */
    public function getBirthDateAttribute($date)
    {
        return date('d.m.Y', strtotime($date));
    }

    // Получить исследования пациента
    public function researches()
    {
        return $this->hasMany('App\PatientResearh');
    }
}

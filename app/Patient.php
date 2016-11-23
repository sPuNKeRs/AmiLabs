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
            'more_inform'
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
     * Конвертация даты создания карты
     */
    public function setCardDateAttribute($date)
    {
        $this->attributes['card_date'] = Carbon::createFromFormat('d.m.Y',$date);
    }

    /**
     * Конвертация даты рождения
     */
    public function setBirthDateAttribute($date)
    {
        $this->attributes['birth_date'] = Carbon::createFromFormat('d.m.Y',$date);
    }

}

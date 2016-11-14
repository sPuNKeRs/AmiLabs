<?php

namespace App;

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
}

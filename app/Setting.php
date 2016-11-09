<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_name', 
        'company_address', 
        'company_phone', 
        'company_email', 
        'company_head_id'
    ];
}

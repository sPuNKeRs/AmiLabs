<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'first_name', 'second_name', 'last_name', 'phone', 'email','address', 'specialty_id','avatar'
    ]; 

     /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_id'
    ];

    /**
     * Get user whose profile.
     */
    public function user()
    {
    	$this->belongsTo('App\User');
    }

}

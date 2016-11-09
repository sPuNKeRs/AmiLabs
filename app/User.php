<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'user_type_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get all users list.
     *
     * @return  array user list
     */
    public static function getArray()
    {
        $users = User::orderBy('id','ASC')->get();
        $options = array();

        foreach ($users as $user) {
            $options[$user->id] = $user->name;
        }

        return $options;
    }
}

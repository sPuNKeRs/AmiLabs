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

    /**
     * Get the user profile.
     */
    public function profile()
    {
        return $this->hasOne('App\Profile');
    }

    /**
     * User role relationship.
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role', 'user_role', 'user_id', 'role_id');
    }

    /**
     * Check has any role.
     */
    public function hasAnyRole($roles)
    {
        if(is_array($roles))
        {
            foreach ($roles as $role) {
                if($this->hasRole($role))
                {
                    return true;
                }
            }
        }
        else
        {
            if($this->hasRole($roles))
            {
                return true;
            }
        }
        return false;
    }

    /**
     * Check has role.
     */
    public function hasRole($role)
    {
        if($this->roles()->where('name', $role)->first())
        {
            return true;
        }

        return false;
    }

    /**
     * Get full name
     */
    public function getFullName()
    {
        
        return $this->profile->first_name.' '.$this->profile->second_name.' '.$this->profile->last_name;
    }
}

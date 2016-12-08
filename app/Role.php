<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * Role user relationship.
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'user_role', 'role_id', 'user_id');
    }

     /**
     * Get all user role list.
     *
     * @return  array user role list
     */
    public static function getArray()
    {
        $user_type = Role::orderBy('id','ASC')->get();
        $options = array();

        foreach ($user_type as $type) {
            $options[$type->id] = $type->description;
        }

        return $options;
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Research extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];

    // Связь один ко многим - АНАЛИЗЫ
    public function analyses()
    {
        return $this->hasMany('App\Analysis');
    }
}

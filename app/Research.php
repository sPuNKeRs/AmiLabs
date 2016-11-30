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
    public function analyzes()
    {
        return $this->hasMany('App\Analysis');
    }

    // Получить список видов исследований
    public static function getResearchArray()
    {
        $research_list = Research::orderBy('id','ASC')->get();
        $options = array();

        foreach ($research_list as $research) {
            $options[$research->id] = $research->name;
        }

        return $options;
    }
}

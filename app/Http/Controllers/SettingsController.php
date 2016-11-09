<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SettingsRequest;

use App\User;
use App\Setting;

class SettingsController extends Controller
{
    // Начальная страница "Настройки"
    public function index()
    {
        $settings = Setting::first();

        return view('admin.settings.index', compact('settings'));
    }

    // Сохранения настроек
    public function edit(SettingsRequest $request)
    {
    	$input = $request->except('_token');

    	if(!Setting::first())
    	{
    		Setting::create($input);	
    	}
    	
    	Setting::first()->update($input);

    	//dd(Setting::first());

    	return redirect('settings')->with(['status'=>'Настройки успешно сохранены.']);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    // Начальная страница "Настройки"
    public function index(Request $request)
    {
    	return view('admin.settings.index');
    }
}

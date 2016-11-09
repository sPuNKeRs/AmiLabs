<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;

class SettingsController extends Controller
{
    // Начальная страница "Настройки"
    public function index()
    {
        $settings = Setting::first();
        return view('admin.settings.index', compact('settings'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistryController extends Controller
{
    // Начальная страница регистратуры
    public function index(Request $request)
    {
      return view('registry.index');
    }
}

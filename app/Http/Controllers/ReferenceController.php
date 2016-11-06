<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReferenceController extends Controller
{
    // Начальная страница Справочники
    public function index(Request $request)
    {
        return view('admin.reference.index');
    }
}

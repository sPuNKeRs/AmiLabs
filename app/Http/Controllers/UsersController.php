<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    // Начальная страница Пользователей
    public function index(Request $request)
    {
        return view('admin.users.index');
    }
}

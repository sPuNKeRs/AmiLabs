<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserCreateRequest;
use Illuminate\Support\Facades\Validator;
use App\User;

class UsersController extends Controller
{
    // Начальная страница Пользователей
    public function index(Request $request)
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // Страница создания пользователя
    public function userCreate()
    {
        return view('admin.users.create');
    }

    // Сохранение пользователя
    public function create(UserCreateRequest $request)
    {
        dd($request);
    }
}

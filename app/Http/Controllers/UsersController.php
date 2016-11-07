<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserEditRequest;
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
        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'user_type_id' => $request['user_type_id'],
            'password' => bcrypt($request['password'])
        ]);

        return redirect('users')->with(['status'=>'Пользователь '.$request->name.' успешно создан.']);
    }

    // Страница редактирования пользователя
    public function userEdit($userid)
    {
        $user = User::find($userid);

        return view('admin.users.edit', compact('user'));
    }

    // Редактирование пользователя
    public function edit(UserEditRequest $request)
    {
        dd($request);
    }
}

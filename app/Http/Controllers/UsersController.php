<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserEditRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
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
        $input = $request->all();
        $user = User::find($request->userid);

        // Проверяем уникальность e-mail
        $this->validate($request, [
            'email' => [Rule::unique('users')->ignore($request->userid), 'required', 'max:255' ],                     
        ]);

        // Проверяем требование к паролю
        if($request->password)
        {
            $this->validate($request, [
                'password' => 'min:6|confirmed']
            );

            $input['password'] = bcrypt($input['password']);
        }

        // Сохраняем изменения
        $user->update($input);
        return redirect('users')->with(['status'=>'Данные пользователя '.$user->name.' успешно обновлены.']);
    }

    // Удаление пользователя
    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('users')->with(['status'=>'Пользователь '.$user->name.' успешно удален.']);
    }
}

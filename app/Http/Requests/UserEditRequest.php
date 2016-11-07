<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'email' => ['required','email','max:255'],
            //'unique:users'
            // 'password' => 'required|min:6|confirmed',
            'user_type_id' => 'required'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [         
            'name.required' => 'Поле "ФИО" обязательно для заполения',   
            'email.required' => 'Поле "Электронный адрес" обязательно для заполения',
            'email.email' => 'Неверный формат поля "Электронный адрес"',
            // 'email.unique' => 'Данный "Электронный адрес" уже есть в системе',
            // 'password.required' => 'Поле "Пароль" обязательно для заполения',
            // 'password.min' => 'Поле "Пароль" должно быть не менее 6 символов',
            // 'password.confirmed' => 'Поле "Пароль и Повтор пароля должны совпадать"',
            'user_type_id.required' => 'Поле "Тип пользователя" обязательно для заполения'
        ];
    }
}

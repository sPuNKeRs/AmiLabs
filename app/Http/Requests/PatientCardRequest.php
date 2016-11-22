<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientCardRequest extends FormRequest
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
            'card_number' => 'required',
            'card_date' => 'required',
            'surname' => 'required',
            'firstname' => 'required',
            'gender' => 'required',
            'birth_date' => 'required',
            'email' => 'email'
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
            'card_number.required' => 'Номер карты обязателен для заполнения',
            'card_date.required' => 'Дата карты обязательна для заполенения',
            'surname.required' => 'Фамилия обязательна для заполнения',
            'firstname.required' => 'Имя обязательно для заполнения',
            'gender.required' => 'Укажите пол',
            'birth_date.required' => 'Дата рождения обязательна для заполнения',
            'email.email' => 'Неверный формат электронного адреса'
        ];
    }
}

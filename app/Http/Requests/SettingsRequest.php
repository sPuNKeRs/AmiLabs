<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingsRequest extends FormRequest
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
            'company_name' => 'required',
            'company_address' => 'required',
            'company_phone' => 'required',
            'company_email' => 'required|email',
            'company_head_id' => 'required'
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
            'company_name.required' => 'Поле "Наименование организации" обязательно для заполения',
            'company_address.required' => 'Поле "Адрес организации" обязательно для заполения', 
            'company_phone.required' => 'Поле "Телефон" обязательно для заполения', 
            'company_email.required' => 'Поле "Электронная почта" обязательно для заполения', 
            'company_email.email' => 'Поле "Электронная почта" должно быть действительным электронным адресом', 
            'company_head_id.required' => 'Поле "Заведующий КДЛ" обязательно для заполения',                
        ];
    }
}

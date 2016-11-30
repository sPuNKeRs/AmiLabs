<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientResearhRequest extends FormRequest
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
            'patient_id' => 'required',
            'research_id' => 'required',
            // 'create_date' => 'required',
            // 'status' => 'required'
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
            'patient_id.required' => 'ID пациента обязателен для заполнения',
            'research_id.required' => 'ID вида исследования обязателен для заполнения',
            'create_date.required' => 'Дата исследования обязателена для заполнения',
            'status.required' => 'Статус исследования обязателен для заполнения'
        ];
    }
}

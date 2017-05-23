<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConvertRequest extends FormRequest
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
            'info' => 'required|string|',
            'date' => 'required|date|after:today'
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
            'info.required' => 'You can\'t leave the info blank, an appointment will need details',
            'date.required' => 'A date is required to book an appointment',
            'date.after' => 'An appointment must be booked for after today'
        ];
    }
}

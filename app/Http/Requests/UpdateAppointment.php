<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAppointment extends FormRequest
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
            'appointment.name' => 'required|string|max:255',
            'appointment.email' => 'required|string|email|max:255',
            'appointment.info' => 'required|string|',
            'appointment.date' => 'required|date|after:today'
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
            'appointment.name.required' => 'A name is required to convert a request',
            'appointment.email.required' => 'An email is required to convert a request',
            'appointment.email.email' => 'This doesn\'t look like an email to us, please try again',
            'appointment.info.required' => 'You can\'t leave the info blank, an appointment will need details',
            'appointment.date.required' => 'A date is required to book an appointment',
            'appointment.date.after' => 'An appointment must be booked for after today'
        ];
    }
}

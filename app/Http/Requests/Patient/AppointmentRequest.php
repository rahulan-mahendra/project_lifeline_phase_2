<?php

namespace App\Http\Requests\Patient;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Patient\ClinicAppointmentTimeRule;

class AppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(Request $request): array
    {
        return [
            'firstname' => 'required|max:100',
            'lastname' => 'required|max:100',
            'email' => 'required|email|max:100',
            'phone_no' => 'required|numeric',
            'dob' => 'required|date|date_format:Y-m-d',
            'clinic' => 'required|exists:clinics,id',
            'appointment_date' => 'required|date|date_format:Y-m-d',
            'appointment_time' => [
                'required',
                 new ClinicAppointmentTimeRule($request->clinic, $request->day_index)
            ],
            'is_new_patient' => 'required|in:0,1'
        ];
    }

    public function messages(): array
    {
        return [
            'phone_no.required' => 'The phone number field is required',
            'clinic.exists' => 'Please enter existing clinic',
            'dob.required' => 'The date of birth field is required',
            'appointment_date.required' => 'The appointment date field is required',
            'appointment_time.required' => 'The appointment time field is required',
            'is_new_patient.required' => 'The new patient field is required'
        ];
    }
}

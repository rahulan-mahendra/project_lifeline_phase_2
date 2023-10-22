<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentCancellationRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'cancellation_requested_by_patient' => 'required|in:0,1',
            'cancellation_notes' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'cancellation_requested_by_patient.required' => 'The requested by patient field is required',
            'cancellation_requested_by_patient.in' => 'The options should either be Yes or No',
            'cancellation_notes.required' => 'The cancalleation notes field is required',
        ];
    }
}

<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ClinicAlertRequest extends FormRequest
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
        if($this->route('clinic_alert')){
            $id = $this->route('clinic_alert')->id;
        }

        switch($this->method()) {
            case 'GET':
            case 'DELETE':
                {
                    return [];
                }
            case 'POST':
                {
                    return [
                        'clinic_id' => 'required|max:100|unique:clinic_alerts,clinic_id',
                        'message' => 'required',
                    ];
                }
            case 'PUT':
                {
                    return [
                        'message' => 'required',
                    ];
                }
            default:break
                ;
        }
    }

    public function messages(): array
    {
        return [
            'clinic_id.required' => 'The clinic field is required',
            'message.required' => 'The alert message field is required',
        ];
    }
}

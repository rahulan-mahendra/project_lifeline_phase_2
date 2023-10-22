<?php

namespace App\Http\Requests\Admin;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Admin\ClinicAppointmentTimeRule;

class ClinicRequest extends FormRequest
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
        // dd($request->all());
        if($this->route('clinic')){
            $id = $this->route('clinic')->id;
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
                        'name' => 'required|max:100|unique:clinics,name',
                        'email' => 'required|email|unique:clinics,email|max:100',
                        'contact_no' => 'required|numeric|unique:clinics,contact_no',
                        'days.*.is_open' => 'required|boolean|in:1,0',
                        'days.*.open_time' => 'exclude_if:days.*.is_open,0|required',
                        'days.*.close_time' => 'exclude_if:days.*.is_open,0|required',
                    ];
                }
            case 'PUT':
                {
                    return [
                        'name' => 'required|max:100|unique:clinics,name,'.$id,
                        'email' => 'required|email|max:100|unique:clinics,email,'.$id,
                        'contact_no' => 'required|numeric|min:12|unique:clinics,contact_no,'.$id,
                        'days.*.is_open' => 'required|boolean|in:1,0',
                        'days.*.open_time' => 'exclude_if:days.*.is_open,0|required',
                        'days.*.close_time' => 'exclude_if:days.*.is_open,0|required',
                    ];
                }
            default:break
                ;
        }
    }

    public function messages(): array
    {
        return [
            'contact_no.required' => 'The contact number field is required',
            'appointment_start_time.required' => 'The clinic open time field is required',
            'appointment_end_time.required' => 'The clinic close time field is required',

            //Days
            'days.*.open_time' => 'The open time field is required',
            'days.*.close_time' => 'The close time field is required',
        ];
    }
}


//Days
// 'Monday_is_open' => 'required|boolean|in:1,0',
// 'Monday_open_time' => 'exclude_if:Monday_is_open,0|required',
// 'Monday_close_time' => 'exclude_if:Monday_is_open,0|required',

// 'Tuesday_is_open' => 'required|boolean|in:1,0',
// 'Tuesday_open_time' => 'exclude_if:Tuesday_is_open,false|required',
// 'Tuesday_close_time' => 'exclude_if:Tuesday_is_open,false|required',

// 'Wednesday_is_open' => 'required|boolean|in:1,0',
// 'Wednesday_open_time' => 'exclude_if:Wednesday_is_open,false|required',
// 'Wednesday_close_time' => 'exclude_if:Wednesday_is_open,false|required',

// 'Thursday_is_open' => 'required|boolean|in:1,0',
// 'Thursday_open_time' => 'exclude_if:Thursday_is_open,false|required',
// 'Thursday_close_time' => 'exclude_if:Thursday_is_open,false|required',

// 'Friday_is_open' => 'required|boolean|in:1,0',
// 'Friday_open_time' => 'exclude_if:Friday_is_open,false|required',
// 'Friday_close_time' => 'exclude_if:Friday_is_open,false|required',

// 'Saturday_is_open' => 'required|boolean|in:1,0',
// 'Saturday_open_time' => 'exclude_if:Saturday_is_open,false|required',
// 'Saturday_close_time' => 'exclude_if:Saturday_is_open,false|required',

// 'Sunday_is_open' => 'required|boolean|in:1,0',
// 'Sunday_open_time' => 'exclude_if:Sunday_is_open,false|required',
// 'Sunday_close_time' => 'exclude_if:Sunday_is_open,false|required'

<?php

namespace App\Http\Requests\Admin;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        if($this->route('user')){
            $id = $this->route('user')->id ;
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
                        'firstname' => 'required|max:100',
                        'lastname' => 'max:100',
                        'email' => 'required|email|unique:users,email|max:100',
                        'role' => 'required|exists:roles,id',
                        'clinic_id' => 'required|exists:clinics,id',
                        'password' => 'required|confirmed|min:8',
                    ];
                }
            case 'PUT':
                {
                    return [
                        'firstname' => 'required|max:100',
                        'lastname' => 'max:100',
                        'email' => 'required|email|max:100|unique:users,email,'.$id,
                    ];
                }
            default:break
                ;
        }
    }

    public function message(): array
    {
        return [
            //
        ];
    }
}

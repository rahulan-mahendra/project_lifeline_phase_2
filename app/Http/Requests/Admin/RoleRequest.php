<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
        if($this->route('role')){
            $id = $this->route('role')->id ;
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
                        'name' => 'required|unique:roles,name|max:100',
                    ];
                }
            case 'PUT':
                {
                    return [
                        'name' => 'required|max:100|unique:roles,name,'.$id,
                    ];
                }
            default:break
                ;
        }
    }

    public function messages(): array
    {
        return [
            //
        ];
    }
}

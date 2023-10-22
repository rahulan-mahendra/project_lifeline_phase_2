<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
        if($this->route('id')){
            $id = $this->route('id');
        }

        return [
            'firstname' => 'required|max:100',
            'lastname' => 'required|max:100',
            'email' => 'required|email|max:100|unique:users,email,'.$id,
        ];
    }
}

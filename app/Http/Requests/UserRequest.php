<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
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
            'first_name' => 'required | alpha_num | max:25',
            'last_name' => 'required | alpha_num | max:25',
            'email' => 'required | email:dns',
            'role' => 'required | exists:roles,role_id',
            'gender' => 'required | exists:genders,gender_id',
            'image' => 'required | file | mimes:jpg,png,jpeg',
            'password' => ['required', 'string', Password::min(8)->numbers(), 'confirmed'],
            'password_confirmation' => 'required'
        ];
    }
}

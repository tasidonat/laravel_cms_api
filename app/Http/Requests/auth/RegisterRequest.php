<?php

namespace App\Http\Requests\auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:4',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'password_retype' => 'required|same:password'
        ];
    }

    public function messages()
    {
        return [
            'email.email' => 'Email is not valid!',
            'name.min' => 'Name has to be minimum :min characters!',
            'name.required' => 'Name is required!',
            'password_retype' => 'Not the same as password!',
            'password.min' => 'Password has to be minimum :min characters!',
            'email.required' => 'Email is mandatory',
            'password.required' => 'Password is mandatory',
            'email.unique' => 'Email is already registered'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
{
    return [
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'phone' => 'required|digits_between:7,15',
        'address' => 'required|string',
        'dui' => 'required|digits:9|unique:clients,dui'
    ];
}
}
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'nullable|string|between:3,15',
            'email' => 'nullable|email:rfc,spoof|max:255|unique:users',
            'password' => 'nullable|string|min:8|confirmed',
        ];
    }
}

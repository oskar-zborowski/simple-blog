<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|between:3,15',
            'email' => 'required|email:rfc,spoof|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ];
    }
}

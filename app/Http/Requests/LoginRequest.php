<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        $user = Auth::user();

        if ($user) {
            return false;
        }

        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|email:rfc,spoof|max:255',
            'password' => 'required|string|min:8',
        ];
    }
}

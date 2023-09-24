<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SetUserRoleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'role' => 'required|integer|between:1,3',
        ];
    }
}

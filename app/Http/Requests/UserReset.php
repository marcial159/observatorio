<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserReset extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'bail|required|string|email|max:100',
            'token' => 'bail|required|numeric|digits:4',
            'password' => 'bail|required|confirmed|string|min:6',
        ];
    }
}

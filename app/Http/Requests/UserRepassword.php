<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRepassword extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'token' => 'bail|required',
            'password' => 'bail|required|confirmed|string|min:6',
        ];
    }
}

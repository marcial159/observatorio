<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserAuthenticate extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'type' => 'bail|required',
            'g-recaptcha-response' => 'bail|required',
            'email' => 'bail|nullable|email|min:5|max:100',
            'document' => 'bail|nullable|string|min:8|max:20',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRecover extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'bail|required|email|max:100',
        ];
    }
}
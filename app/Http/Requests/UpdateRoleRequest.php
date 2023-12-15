<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateRoleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(Request $request)
    {
        return [
            'name' => 'bail|required|string|min:2|max:30|unique:roles,name,'.$request->id,
            'guard_name' => 'bail|required|string|max:10',
        ];
    }
}

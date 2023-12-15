<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreRoleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'bail|required|string|min:2|max:30|unique:roles',
            'guard_name' => 'bail|required|string|max:10',
        ];
    }
}

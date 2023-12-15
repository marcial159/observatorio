<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules( Request $request )
    {
        return [
            'type_id' => 'bail|nullable|numeric',
            // 'firstname' => 'bail|required|string|max:50|unique:users,firstname,NULL,id,lastname,'.$request->lastname.','.$request->id.'|unique:persons,firstname,NULL,id,lastname,'.$request->lastname.','.$request->person_id,
            'lastname' => 'bail|required|string|max:50',    
            'email' => 'bail|required|email|max:100|unique:users,email,'.$request->id,
            // 'phone' => 'bail|required|string|min:9|max:30|unique:persons,phone,'.$request->person_id,
            'gender' => 'bail|required|in:M,F',            
            'role_id' => 'bail|required|numeric'
        ];
    }
}

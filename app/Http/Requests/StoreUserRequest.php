<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules( Request $request )
    {
        // |unique:users,firstname,NULL,id,lastname,'.$request->lastname
        return [
            'type_id' => 'bail|nullable|numeric',
            'document' => 'bail|required|numeric||digits:8',
            'firstname' => 'bail|required|string|max:50',
            'lastname' => 'bail|required|string|max:50',    
            'email' => 'bail|required|email|max:100',
            'phone' => 'bail|required|string|min:9|max:30',
            'gender' => 'bail|required|in:M,F',            
            'role_id' => 'bail|required|numeric'
        ];
    }
}

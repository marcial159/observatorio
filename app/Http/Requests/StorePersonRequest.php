<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StorePersonRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            //|unique:user,firstname,NULL,id,lastname_name,'.$request->lastname,
            'gender' => 'bail|required|in:M,F',
            'document' => 'bail|required|numeric|digits:8',
            'firstname' => 'bail|required|string|max:50',
            'lastname' => 'bail|required|string|max:50',      
            'email' => 'bail|required|email|max:100|unique:users,email',
            'phone' => 'bail|required|string|min:9|max:30|unique:persons,phone',
        ];
    }
}

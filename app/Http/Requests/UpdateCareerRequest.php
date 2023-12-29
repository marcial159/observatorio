<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateCareerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules( Request $request )
    {
        return [
            'program' => 'required|string|max:3|unique:careers,program'.$request->id,
            'name' => 'required|max: 30|unique:careers,name,'.$request->id,
            'acronym' => 'required|string|max: 40|unique:careers,acronym,'.$request->id,
            'faculty_id' => 'required|integer|max:10|unique:careers,faculty_id'.$request->id,
            'shield' => 'required|string|max:30|unique:careers,shield'.$request->id,
        ];
    }
}

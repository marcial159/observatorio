<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateFacultyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules( Request $request )
    {
        return [
            'name' => 'required|max: 30|unique:faculties,name,'.$request->id,
            'acronym' => 'required|string|max: 40|unique:faculties,acronym,'.$request->id,
        ];
    }
}

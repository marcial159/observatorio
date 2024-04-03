<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateStudentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules( Request $request )
    {
        return [
            'person_id' => 'required|integer|max:20|unique:students,person_id'.$request->id,
            'code' => 'required|string|max: 30|unique:students,code,'.$request->id,
            'asignament_id' => 'required|integer|max:20|unique:students,asignament_id,'.$request->id,            
        ];
    }
}

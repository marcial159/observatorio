<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateinvestigationStudentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules( Request $request )
    {
        return [
            'investigation_id' => 'required|integer|max:10|unique:investigation_student,investigation_id'.$request->id,
            'student_id' => 'required|integer|max:10|unique:investigation_student,student_id'.$request->id,           
        ];
    }
}

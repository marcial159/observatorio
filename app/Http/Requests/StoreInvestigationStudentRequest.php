<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreInvestigationStudentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'investigation_id' => 'required|integer|max:10|unique:investigation_student,investigation_id',
            'student_id' => 'required|integer|max:10|unique:investigation_student,student_id',
        ];
    }
}

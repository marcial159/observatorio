<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreCareerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'investigation_id' => 'required|integer|max:10|unique:careers,faculty_id',
            'student_id' => 'required|integer|max:10|unique:careers,faculty_id',
            'faculty_id' => 'required|integer|max:10|unique:careers,faculty_id',
            'shield' => 'required|string|max:30|unique:careers,shield',
        ];
    }
}

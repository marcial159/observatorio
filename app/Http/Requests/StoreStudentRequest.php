<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'person_id' => 'required|integer|max:20|unique:students,person_id',
            'code' => 'required|string|max:6|unique:students,code',
            'asignament_id' => 'required|integer|max:20|unique:students,asignament_id',            
        ];
    }
}

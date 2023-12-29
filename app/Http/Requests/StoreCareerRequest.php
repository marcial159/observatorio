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
            'program' => 'required|string|max:3|unique:careers,program',
            'name' => 'required|string|max:50|unique:careers,name',
            'acronym' => 'required|string|max:10|unique:careers,acronym',
            'faculty_id' => 'required|integer|max:10|unique:careers,faculty_id',
            'shield' => 'required|string|max:30|unique:careers,shield',

        ];
    }
}

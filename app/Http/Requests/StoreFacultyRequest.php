<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreFacultyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:30|unique:faculties,name',
            'acronym' => 'required|string|max:40|unique:faculties,acronym',
        ];
    }
}

<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreLaboratoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:100|unique:laboratories,name',
            'ambient' => 'required|string|max:10|unique:laboratories,ambient',
            'description' => 'required|string|max:200|unique:laboratories,description'            

        ];
    }
}

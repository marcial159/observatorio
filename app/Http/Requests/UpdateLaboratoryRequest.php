<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateLaboratoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules( Request $request )
    {
        return [
            'name' => 'required|string|max: 100|unique:laboratories,name,'.$request->id,
            'ambient' => 'required|string|max: 10|unique:laboratories,acronym,'.$request->id,
        ];
    }
}

<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateHeadquarterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules( Request $request )
    {
        return [
            'name' => 'required|max: 30|unique:headquarters,name,'.$request->id,
            'position' => 'required|string|max: 40|unique:headquarters,position,'.$request->id,
        ];
    }
}

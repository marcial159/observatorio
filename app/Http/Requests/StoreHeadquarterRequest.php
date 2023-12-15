<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreHeadquarterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:30|unique:headquarters,name',
            'position' => 'required|string|max:40|unique:headquarters,position',
        ];
    }
}

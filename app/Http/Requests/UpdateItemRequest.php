<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateItemRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules( Request $request )
    {
        return [            
            'name' => 'required|string|max: 255|unique:items,name,'.$this->route('item')->id,
            'description' => 'required|string|max: 255|unique:items,description,'.$this->route('item')->id,
            'type' => 'required|integer|between:0,3|unique:items,type,'.$this->route('item')->id,
            'status' => 'required|integer|between:0,2|unique:items,type,'.$this->route('item')->id,
        ];
    }
}

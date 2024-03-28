<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max: 255|unique:items,name,',
            'description' => 'required|string|max: 255',
            'type' => 'required|integer|between:0,3,',
            'status' => 'required|integer|between:0,2',
        ];
    }
}

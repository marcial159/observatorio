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
        $itemId = $this->route('item')->id;

        return [            
            'name' => 'required|string|max:255|unique:items,name,'.$itemId,
            'description' => 'required|string|max:255',
            'type' => 'required|integer|between:0,3',
            'status' => 'required|integer|between:0,2',
        ];
    }
}

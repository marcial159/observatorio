<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateAnnouncementRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules( Request $request )
    {
        return [
            
            'name' => 'required|max: 30|unique:announcement,name,'.$request->id,            
            'type_project_id' => 'required|integer|max:10|unique:announcement,type_project_id'.$request->id,
            'resolution' => 'required|string|max: 40|unique:announcement,resolution,'.$request->id,
            'short' => 'required|string|max:20|unique:announcement,short'.$request->id,
            'status' => 'required|integer|max:2|unique:announcements,status',.$request->id,
        ];
    }
}

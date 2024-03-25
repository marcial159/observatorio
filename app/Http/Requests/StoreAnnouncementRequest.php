<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreAnnouncementRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            
            'title' => 'required|string|max:50|unique:announcements,title',
            'type_project_id' => 'required|integer|max:10|unique:announcements,type_project_id',
            'resolution' => 'required|string|max:40|unique:announcements,resolution',
            'short' => 'required|string|max:20|unique:announcements,short',
            'status' => 'required|integer|max:2|unique:announcements,status',

        ];
    }
}

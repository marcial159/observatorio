<?php
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public static $wrap = null;

    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'person_id' => $this->resource->person_id,
            'gender' => $this->resource->gender,
            'document' => $this->resource->document,
            'avatar' => $this->resource->avatar,
            'firstname' => $this->resource->firstname,
            'lastname' => $this->resource->lastname,
            'role' => $this->resource->role_id ? $this->resource->role : '',
            'email' => $this->resource->email,
            'phone' => $this->resource->phone,
            'created_at' => date("d/m/Y", strtotime($this->resource->created_at)),
            'updated_at' => date("d/m/Y", strtotime($this->resource->updated_at)),
        ];
    }
}

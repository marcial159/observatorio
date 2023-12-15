<?php
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{
    public static $wrap = null;

    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'guard_name' => $this->resource->guard_name,
            'created' => date("d/m/Y", strtotime($this->resource->created_at)),
            'updated' => date("d/m/Y", strtotime($this->resource->updated_at)),
        ];
    }
}

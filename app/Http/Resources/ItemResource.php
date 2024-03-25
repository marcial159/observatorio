<?php
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    public static $wrap = null;

    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,            
            'name' => $this->resource->name,            
            'description' => $this->resource->description,
            'type' => $this->resource->type,
            'status' => $this->resource->status,
            'created_at' => date("d/m/Y", strtotime($this->resource->created_at)),
            'updated_at' => date("d/m/Y", strtotime($this->resource->updated_at)),
        ];
    }
}

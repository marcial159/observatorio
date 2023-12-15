<?php
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class HeadquarterResource extends JsonResource
{
    public static $wrap = null;

    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'position' => $this->resource->position,
            'created_at' => date("d/m/Y", strtotime($this->resource->created_at)),
            'updated_at' => date("d/m/Y", strtotime($this->resource->updated_at)),
        ];
    }
}

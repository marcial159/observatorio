<?php
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class CareerResource extends JsonResource
{
    public static $wrap = null;

    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'program' => $this->resource->program,
            'name' => $this->resource->name,            
            'acronym' => $this->resource->acronym,
            'faculty_id' => $this->resource->faculty_id,
            'shield' => $this->resource->shield,
            'created_at' => date("d/m/Y", strtotime($this->resource->created_at)),
            'updated_at' => date("d/m/Y", strtotime($this->resource->updated_at)),
        ];
    }
}

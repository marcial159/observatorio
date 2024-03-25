<?php
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class AnnouncementResource extends JsonResource
{
    public static $wrap = null;

    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'title' => $this->resource->title,           
            'type_project_id' => $this->resource->type_project_id,
            'resolution' => $this->resource->resolution,
            'short' => $this->resource->short,
            'status' => $this->resource->status,
            'created_at' => date("d/m/Y", strtotime($this->resource->created_at)),
            'updated_at' => date("d/m/Y", strtotime($this->resource->updated_at)),
        ];
    }
}

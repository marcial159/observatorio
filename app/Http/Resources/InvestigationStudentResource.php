<?php
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class InvestigationStudentResource extends JsonResource
{
    public static $wrap = null;

    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'investigation_id' => $this->resource->investigation_id,
            'student_id' => $this->resource->student_id,
            'created_at' => date("d/m/Y", strtotime($this->resource->created_at)),
            'updated_at' => date("d/m/Y", strtotime($this->resource->updated_at)),
        ];
    }
}

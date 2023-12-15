<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvApi extends Model
{
    protected $table = 'investigations';
    protected $with = ['authors'];

    public function authors()
    {
        return $this->belongsToMany(Lecturer::class,'lecturer_project','investigation_id','lecturer_id')->where('position',1);
    }

    public function scopeTitle($query, $title)
    {
        if($title)
        return $query->where('title', 'LIKE', "%".$title."%");
    }

    public function scopeCode($query, $code)
    {
        if($code)
        return $query->where('code', $code);
    }

    public function scopeLecturer($query, $lecturer)
    {
        if($lecturer)
        return $query->join('lecturer_project', 'investigations.id', 'lecturer_project.investigation_id')
                     ->where('lecturer_project.lecturer_id',$lecturer)
                     ->select('investigations.*');
    }
}

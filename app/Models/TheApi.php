<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TheApi extends Model
{
    protected $table = 'thesis';
    protected $with = ['authors'];

    // public function getResolutionDateAttribute($value)
    // {
    //     return date("d-m-Y", strtotime($value));
    // }

    // public function getCronogramFinishAttribute($value)
    // {
    //     return date("d-m-Y", strtotime($value));
    // }

    // public function getPeriodFinishAttribute($value)
    // {
    //     return date("d-m-Y", strtotime($value));
    // }

    // public function getExtensionFinishAttribute($value)
    // {
    //     return date("d-m-Y", strtotime($value));
    // }

    public function authors()
    {
        return $this->belongsToMany(Student::class,'student_project','thesis_id','student_id');
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

    public function scopeStudent($query, $student)
    {
        if($student)
        return $query->join('student_project', 'thesis.id', 'student_project.thesis_id')
                     ->where('student_project.student_id',$student)
                     ->select('thesis.*');
    }
}

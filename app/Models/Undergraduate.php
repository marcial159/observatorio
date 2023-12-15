<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Undergraduate extends Model
{
    protected $table    = 'undergraduates';
    protected $fillable = [
                            'title',
                            'asignament_id',
                            'line_id',
                            'status',
                            'advance',
                            'resolution',
                            'resolution_date',
                            'start',
                            'end',
                            'amount',
                            'finance_id',
                            'announcement_id',
                            'general',
                            'specific',
                            'report',
                            'code',
                            'cronogram_finish',
                            'period_finish',
                            'extension_finish',
                            'monitor_id',
                            'step_id',
                        ];
    // public function getPeriodFinishAttribute($value)
    // {
    //     return date("d-m-Y", strtotime($value));
    // }

    // public function getExtensionFinishAttribute($value)
    // {
    //     return date("d-m-Y", strtotime($value));
    // }

    public function author()
	{
   	    return $this->belongsToMany(Student::class,'student_project')->withPivot('created_at','updated_at');
    }

	public function jury()
    {
        return $this->belongsToMany(Lecturer::class,'juries')->withPivot('position');
    }

    public function adviser()
    {
        return $this->belongsToMany(Lecturer::class,'advisers')->withPivot('position');
    }

    public function asignament()
    {
        return $this->belongsTo(Asignament::class);
    }

    public function monitor()
    {
        return $this->belongsTo(User::class,'monitor_id','id');
    }

    public function actual()
    {
        return $this->belongsTo(Step::class,'step_id','id');
    }

    public function situations(){
        return $this->belongsToMany(Step::class,'stages')->withPivot('created_at','updated_at');
    }

    public function line()
    {
        return $this->belongsTo(Line::class);
    }

    public function announcement()
    {
        return $this->belongsTo(Announcement::class);
    }

    public function by()
    {
        return $this->hasOne(StudentProject::class);
    }

    public function guide()
    {
        return $this->hasOne(Adviser::class);
    }

    public function juries()
    {
        return $this->hasOne(Jury::class);
    }

    public function timeline()
    {
        return $this->hasOne(Stage::class);
    }


    public function headquarter()
    {
        return $this->belongsTo(Headquarter::class);
    }

    public function finance()
    {
        return $this->belongsTo(Finance::class);
    }

    public function scopeTitle($query, $title)
    {
        if($title)
        return $query->where('undergraduate.title', 'LIKE', "%".$title."%");
    }

    public function scopeCode($query, $code)
    {
        if($code)
        return $query->where('undergraduate.code', $code);
    }

    public function scopeStudent($query, $student)
    {
        if($student)
        return $query->join('student_project', 'undergraduate.id', 'student_project.undergraduate_id')
                     ->where('student_project.student_id',$student)
                     ->select('undergraduate.*');
    }

    public function scopeMonitor($query, $monitor)
    {
        if($monitor)
        return $query->where('monitor_id', $monitor);
    }

    public function scopeCareer($query, $career)
    {
        if($career)
        return $query->join('lines', 'undergraduate.line_id', '=', 'lines.id')
                     ->where('lines.career_id','=',$career)
                     ->select('undergraduate.*', 'lines.career_id');
    }

    public function scopeStatus($query, $status)
    {
        if($status)
        return $query->where('status', $status);
    }

    public function scopeFinance($query, $finance)
    {
        if($finance)
        return $query->where('finance_id', $finance);
    }

    public function scopeAnnouncement($query, $announcement)
    {
        if($announcement)
        return $query->where('announcement_id', $announcement);
    }
    public function scopeAdviser($query, $adviser)
    {
        if($adviser)
        return $query->join('advisers', 'advisers.undergraduate_id', '=', 'undergraduate.id')
                     ->where('advisers.lecturer_id','=',$adviser)
                     ->select('undergraduate.*');
    }
}

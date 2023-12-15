<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestigationStudent extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'investigation_id',
        'student_id'
    ];

    protected $with = [ 'student' ];

    public function student()
    {
        return $this->belongsTo( Student::class, 'student_id', 'id' );
    }
}

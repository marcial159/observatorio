<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestigationLecturer extends Model
{
    use HasFactory;

    protected $table = 'investigation_lecturer';

    protected $fillable = [
        'lecturer_id',
        'investigation_id',
        'principal',
    ];

    // protected $with = [ 'lecturer' ];

    public function lecturer()
    {
        return $this->belongsTo( Lecturer::class );
    }
}

<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investigation extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'title',
        'asignament_id',
        'line_id',
        'resolution',
        'resolution_date',
        'start',
        'end',
        'announcement_id',
        'impact_id',
        'general',
        'specific',
        'observation',
        'min_period',
        'max_period',
        'chrono_period',
        'exten_period',
        'advance',
        'status',
        'diffusion',
        'monitor_id',
        'node_id',
    ];

    public function asignament()
    {
        return $this->belongsTo( Asignament::class );
    }

    public function lecturers()
    {
        return $this->belongsToMany( Lecturer::class )->withPivot('principal');
    }

    public function students()
    {
        return $this->belongsToMany( Student::class );
    }

    public function laboratories()
    {
        return $this->belongsToMany( Laboratory::class );
    }

    public function node()
    {
        return $this->belongsTo( Node::class );
    }

    // public function monitor()
    // {
    //     return $this->belongsTo( User::class, 'monitor_id','id' );
    // }

    public function impact()
    {
        return $this->belongsTo( Impact::class );
    }

    public function line()
    {
        return $this->belongsTo( Line::class );
    }

    public function headquarter()
    {
        return $this->belongsTo( Headquarter::class );
    }

    public function announcement()
    {
        return $this->belongsTo( Announcement::class );
    }

    public function scopeTitle( $query, $title )
    {
        if( $title )
        return $query->where( 'investigations.title', 'LIKE', "%".$title."%" );
    }

    public function scopeCode( $query, $code )
    {
        if( $code )
        return $query->where( 'code', $code );
    }

    public function scopeLecturer( $query, $lecturer )
    {
        if( $lecturer )
        return $query->join( 'investigation_lecturer', 'investigations.id', 'investigation_lecturer.investigation_id' )
                     ->where( 'investigation_lecturer.lecturer_id' ,$lecturer )
                     ->select( 'investigations.*' );
    }

    public function scopeMonitor( $query, $monitor )
    {
        if( $monitor )
        return $query->where( 'monitor_id', $monitor );
    }

    public function scopeAnnouncement( $query, $announcement )
    {
        if( $announcement )
        return $query->where( 'announcement_id', $announcement );
    }

    public function scopeImpact( $query, $impact )
    {
        if( $impact )
        return $query->where( 'impact_id', $impact );
    }

    public function scopeStatus( $query, $status )
    {
        if( $status )
        return $query->where( 'status', $status );
    }

    public function scopeAsignament( $query, $asignament_id )
    {
        if( $asignament_id )
        return $query->join('asignaments', 'investigations.asignament_id', 'asignament.id')
                     ->where('asignament_id', $asignament_id )
                     ->select('investigations.*');
    }
}

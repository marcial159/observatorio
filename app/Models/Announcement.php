<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable   = [
		'title',
		'type_project_id',
		'resolution',
		'short',
		'release',
		'culmination',
		'status',
	];
    
	public 	  $timestamps = false;

    public function typeProject()
    {
       return $this->belongsTo( TypeProject::class );
    }

    public function scopeTitle( $query, $title )
	{
		if( $title )
		return $query->where( 'title', 'like', '%'.$title.'%' );
	}

    public function scopeShort( $query, $short )
	{
		if( $short )
		return $query->where( 'short', 'like', '%'.$short.'%' );
	}
	
    public function scopeTypeProject( $query, $type_project )
	{
		if( $type_project )
		return $query->where( 'type_project_id', $type_project );
	}

    public function scopeStatus( $query, $status )
	{
		if( $status )
		return $query->where( 'status', $status );
	}
}

<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    protected $table 	= 'careers';
    protected $fillable = [
		'program',
		'local',
		'name',
		'acronym',
		'faculty_id',
		'headquarter_id',
		'shield'
	];
    // public $timestamps  = false;

    public function Author()
	{
   		return $this->hasMany( Author::class );
	}

	public function Faculty()
	{
	   return $this->belongsTo( Faculty::class );
	}

	public function Headquarter()
	{
	   return $this->belongsTo( Headquarter::class );
	}

	public function ScopeName( $query, $name )
	{
		if( $name )
		return $query->where( 'name', 'like', '%'.$name.'%' );
	}

	public function ScopeFaculty( $query, $faculty )
	{
		if( $faculty )
		return $query->where( 'faculty_id', $faculty );
	}

	public function ScopeHeadquarter( $query, $headquarter )
	{
		if( $headquarter )
		return $query->where( 'headquarter_id', $headquarter );
    }
}

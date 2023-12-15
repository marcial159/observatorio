<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
		'person_id',
		'code',
		'asignament_id'
	];

	protected $casts = [
		'code' => 'string',
	];

	protected $with = [ 'person' ];

    public function person()
    {
        return $this->belongsTo( Person::class, 'person_id', 'id' );
    }

	public function thesis()
	{
	   return $this->belongsTo( Thesis::class );
	}

	public function career()
	{
	   return $this->belongsTo( Career::class );
	}

	public function asignament()
    {
        return $this->belongsTo( Asignament::class );
    }

	public function author()
	{
        return $this->belongsToMany( Thesis::class, 'student_project' )->withPivot( 'created_at', 'updated_at' );
	}

	public function identity( $code )
	{
		return Student::where( 'code', $request->code )->get();
	}

	public function scopeCode( $query, $code )
	{
		if( $code )
		return $query->where( 'code', $code );
	}

    public function scopeFullname( $query, $fullname )
    {
        if( $fullname )
        return $query->whereRaw( 'CONCAT( persons.firstname, " ", persons.lastname ) like "%'.$fullname.'%"' );
    }

	public function scopeCareer( $query, $career_id )
	{
		if( $career_id )
		return $query->join( 'asignaments', 'students.asignament_id', '=', 'asignaments.id' )
					 ->where( 'asignaments.career_id', $career_id );
	}

    public function scopeAsignament( $query, $asignament )
	{
		if( $asignament )
		return $query->where( 'students.asignament_id', $asignament );
	}

	public function scopeGender( $query, $gender )
	{
		if( $gender )
		return $query->where( 'gender', $gender );
	}
}

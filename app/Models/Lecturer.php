<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
    use HasFactory;

	protected $fillable = [
        'person_id',
        'grade',
        'category_id',
        'asignament_id',
        'renacyt',
    ];

    protected $with = [ 'person' ];

    public function person()
    {
        return $this->belongsTo( Person::class, 'person_id', 'id' );
    }

    public function project()
    {
        return $this->belongsToMany( Investigation::class, 'LecturerProject ')->withPivot( 'position', 'status' );
    }

    public function jury()
    {
        return $this->belongsToMany( Thesis::class, 'juries' )->withPivot( 'position' );
    }

    public function adviser()
    {
        return $this->belongsToMany( Thesis::class, 'advisers' )->withPivot( 'position' );
    }

    public function asignament()
    {
        return $this->belongsTo( Asignament::class );
    }

    public function career()
    {
       return $this->belongsTo( Career::class );
    }

    public function category()
    {
        return $this->belongsTo( Category::class );
    }

    public function investigation()
    {
        return $this->belongsToMany( Investigation::class, 'lecturer_project' )->withPivot( 'position', 'created_at', 'updated_at' );
    }

    public function scopeFullname( $query, $fullname )
    {
        if( $fullname )
        return $query->whereRaw( 'CONCAT( persons.firstname, " ", persons.lastname ) like "%'.$fullname.'%"' );
    }

    public function scopeCategory( $query, $category )
    {
        if( $category )
        return $query->where( 'category_id', $category );
    }

    public function scopeGender( $query, $gender )
    {
        if( $gender )
        return $query->where( 'gender', $gender );
    }

    public function scopeCareer( $query, $career )
    {
        if( $career )
        return $query->join( 'asignaments', 'lecturers.asignament_id', '=', 'asignaments.id' )
                     ->where( 'asignaments.career_id', $career );
    }
    public function scopeInv( $query, $inv )
    {
        if( $inv )
        return $query->where( $lecturer->investigation->count(), $min );
    }
}

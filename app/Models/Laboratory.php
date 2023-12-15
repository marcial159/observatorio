<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboratory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'ambient',
        'asignament_id',
        'description'
    ];

    public function career()
    {
        return $this->belongsTo( Career::class );
    }

    public function headquarter()
    {
        return $this->belongsTo( Headquarter::class );
    }

    public function asignament()
    {
        return $this->belongsTo( Asignament::class );
    }

    public function scopeName( $query, $name )
	{
		if( $name )
        return $query->where( 'laboratories.name', 'like', '%'.$name.'%' );
    }

    public function scopeAmbient( $query, $ambient )
	{
		if( $ambient )
        return $query->where( 'ambient', 'like', '%'.$ambient.'%' );
    }

    public function scopeHeadquarter( $query , $headquarter )
    {
        if( $headquarter )
        return $query->where( 'asignaments.headquarter_id', $headquarter );
    }

    public function scopeAsignament( $query , $asignament )
    {
        if( $asignament )
        return $query->where( 'laboratories.asignament_id', $asignament );
    }

    public function scopeCareer( $query , $career )
    {
        if( $career )
        return $query->where( 'asignaments.career_id', $career );
    }
}

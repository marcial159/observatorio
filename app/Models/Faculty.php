<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $table    = 'faculties';
    protected $fillable = [
        'name',
        'acronym'
    ];

    public function career()
    {
    	return $this->hasMany( 'App\Career' );
    }

    public function scopeName( $query, $name )
    {
        if( $name )
        return $query->where( 'name', 'like', '%'.$name.'%' );
    }

    public function scopeAcronym( $query, $acronym )
	{
		if( $acronym )
        return $query->where( 'acronym', 'like', '%'.$acronym.'%' );
    }
}

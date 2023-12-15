<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Headquarter extends Model
{
	use HasFactory;
    protected $fillable = [
		'name',
		'position'
	];

    public function scopeName( $query, $name )
	{
		if( $name )
		$query->where( 'name', 'like', '%'.$name.'%' );
    }

    public function scopePosition( $query, $position )
	{
		if( $position )
		$query->where( 'position', 'like', '%'.$position.'%' );
    }
}

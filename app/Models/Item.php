<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table 	= 'items';
    protected $fillable = [
        'name',
        'description',
        'type',
        'status',
    ];
    public function getTypeAttribute($value)
    {
        switch ($value) {
            case 1:
                return 'General';
            case 2:
                return 'Investigación';
            case 3:
                return 'Incubadora';
            default:
                return null; // 
        }
    }
    public function scopeName( $query, $name )
    {
        if( $name )
        return $query->where( 'name', 'like', '%'.$name.'%' );
    }
    public function scopeDescription( $query, $description )
    {
        if( $description )
        return $query->where( 'description', 'like', '%'.$description.'%' );
    }

    public function scopeType( $query, $type )
	{
		if( $type )
        return $query->where( 'type', 'like', '%'.$type.'%' );
    }
    // Accessor para el campo 'status'
    public function getStatusAttribute($value)
    {
        return $value == 1 ? 'Activo' : 'Inactivo';
    }
}

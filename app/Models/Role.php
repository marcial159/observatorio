<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'guard_name'
    ];

    public function getCreatedAtAttribute( $value )
    {
        return date("d-m-Y", strtotime( $value ));
    }

    public function getUpdatedAtAttribute( $value )
    {
        return date("d-m-Y", strtotime( $value ));
    }

    public function scopeName( $query, $name )
    {
        if( $name )
        return $query->where( 'name', 'LIKE', "%".$name."%" );
    }

    public function scopeGuard( $query, $guard )
    {
        if( $guard )
        return $query->where( 'guard_name', 'LIKE', "%".$guard."%" );
    }

}
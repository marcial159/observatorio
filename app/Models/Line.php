<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Line extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'career_id',
        'status',
        'category',
    ];

    public function career()
    {
        return $this->belongsTo( Career::class );
    }

    public function scopeTitle( $query, $title )
    {
        if( $title )
        return $query->where( 'title', 'like', '%'.$title.'%' );
    }

    public function scopeCareer( $query, $career )
    {
        if( $career )
        return $query->where( 'career_id', '=', $career );
    }

    public function scopeCategory( $query, $category )
    {
        if( $category )
        return $query->where( 'category', '=', $category );
    }

    public function scopeStatus( $query, $status )
    {
        if( $status != '' )
        return $query->where( 'status', '=', $status );
    }
}


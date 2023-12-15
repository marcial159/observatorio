<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    use HasFactory;
    
    protected $table    = 'process';
    protected $fillable = [
        'title',
        'description',
        'type_project_id',
        'status',
        'maxd',
        'maxm',
        'maxy',
        'mind',
        'minm',
        'miny',
    ];

    
    public function type_project()
    {
        return $this->belongsTo( typeProject::class );
    }

    public function ScopeTitle( $query, $title )
    {
        if( $title )
        return $query->where( 'title', 'like', '%'.$title.'%' );
    }

    public function ScopeType( $query, $type )
    {
        if( $type )
        return $query->where( 'type_project_id', $type );
    }

    public function ScopeStatus( $query, $status )
    {
        if( $status != '' )
        return $query->where( 'status', $status );
    }
}

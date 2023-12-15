<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignament extends Model
{
    protected $table = 'asignaments';
    protected $fillable = [
        'career_id',
        'headquarter_id',
        'local'
    ];

    protected $with = [
        'career',
        'headquarter'
    ];

    public function career()
    {
        return $this->belongsTo( Career::class );
    }

    public function headquarter()
    {
        return $this->belongsTo( Headquarter::class );
    }
}

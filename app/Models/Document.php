<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table    = 'documents';
    protected $fillable = [
        'project_id',
        'project_code',
        'type',
        'file_id',
        'number',
        'date',
        'description',
        'format'
    ];
    
    public $timestamps  = false;

	public function file()
    {
        return $this->belongsTo(File::class);
    }

    public function ScopeType($query,$type)
	{
		if($type)
		{
			return $query->where('file_id',$type);
		}
	}
}

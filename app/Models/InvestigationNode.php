<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestigationNode extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'investigation_id',
        'node_id',
    ];
}

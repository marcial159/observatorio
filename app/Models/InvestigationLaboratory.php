<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestigationLaboratory extends Model
{
    use HasFactory;

    protected $fillable = [
        'investigation_id',
        'laboratory_id'
    ];
}

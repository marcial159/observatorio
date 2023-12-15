<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    protected $table = 'audit';
    protected $fillable = ['user','module','action','element','element_id','json'];
}

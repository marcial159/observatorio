<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adviser extends Model
{
    protected $table = 'advisers';
    protected $fillable = [
        'undergraduate_id',
        'lecturer_id',
        'position'
    ];
}

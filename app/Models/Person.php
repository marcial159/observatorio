<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    
    protected $table = 'persons';
    protected $fillable = [
        'gender',
        'document',
        'firstname',   
        'lastname',      
        'email',                   
        'phone',    
    ];
    public $timestamps = true;
}

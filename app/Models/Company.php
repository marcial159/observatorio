<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Company extends Model
{
    use HasFactory;

    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->toDateString();
    }


    public function manager()
    {
        return $this->belongsTo(Student::class, 'manager_id', 'id');
    }
}

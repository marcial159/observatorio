<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectItem extends Model
{
    use HasFactory;
    protected $appends = ['available_amount', 'expenses', 'status', 'last_modified', 'name'];


    public function getAvailableAmountAttribute()
    {
        return $this->amount - $this->concepts()->sum('executed_amount');
    }

    public function getNameAttribute()
    {
        return $this->item->name;
    }


    public function getExpensesAttribute()
    {
        return $this->concepts()->sum('executed_amount');
    }

    public function getStatusAttribute()
    {
        if ($this->expenses >= $this->amount) {
            return 'Completado';
        } elseif ($this->expenses > 0) {
            return 'En progreso';
        } else {
            return 'Pendiente';
        }
    }

    public function getLastModifiedAttribute()
    {
        $lastConcept = $this->concepts()->latest()->first();
        if ($lastConcept && $lastConcept->updated_at > $this->updated_at) {
            return $lastConcept->updated_at->format('Y-m-d');
        } else {
            return $this->updated_at->format('Y-m-d');
        }
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function concepts()
    {
        return $this->hasMany(Concept::class, 'item_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Project extends Model
{
    use HasFactory;

    protected $appends = ['status', 'representative', 'available_balance', 'expenses_balance', 'spent_porcentage'];

    public function getAvailableBalanceAttribute()
    {
        $totalAmount = $this->budget - $this->projectItems->sum('amount');
        return $totalAmount;
    }

    public function getExpensesBalanceAttribute()
    {
        $totalExpenses = $this->projectItems->sum('expenses');
        $availableBalance = $this->budget - $totalExpenses;
        return $availableBalance;
    }

    public function getSpentPorcentageAttribute()
    {
        return round($this->projectItems->sum('expenses') / $this->budget * 100, 2);
    }

    public function projectItems()
    {
        return $this->hasMany(ProjectItem::class);
    }

    public function getStatusAttribute()
    {
        return $this->start_schedule <= now() && $this->end_schedule >= now() ? 'Activo' : 'Inactivo';
    }

    public function getRepresentativeAttribute()
    {
        $representative = $this->members->where('type', 'Representante')->first();
        return $representative->student->person->firstname . ' ' . $representative->student->person->lastname;
    }



    public function getStageAttribute()
    {
        return $this->projectStage->name;
    }

    public function getContestAttribute()
    {
        return $this->getRelationValue('contest')->name;
    }

    public function members()
    {
        return $this->hasMany(ProjectMember::class);
    }

    public function contest()
    {
        return $this->belongsTo(Contest::class);
    }

    public function laboratories()
    {
        return $this->belongsToMany(Laboratory::class, 'project_laboratories');
    }

    public function projectLaboratories()
    {
        return $this->hasMany(ProjectLaboratory::class);
    }

    public function projectStage()
    {
        return $this->belongsTo(ProjectStage::class, 'stage_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function items()
    {
        return $this->hasMany(ProjectItem::class);
    }

    public function files()
    {
        return $this->hasMany(ProjectFile::class);
    }

    public function category()
    {
        return $this->belongsTo(ProjectCategory::class);
    }

    public function advisor()
    {
        return $this->belongsTo(User::class, 'advisor_id');
    }

    public function scopeCode($query, $code)
    {
        return $code ? $query->where('code', 'LIKE', '%' . $code . '%') : $query;
    }

    public function scopeTitle($query, $title)
    {
        return $title ? $query->where('title', 'LIKE', '%' . $title . '%') : $query;
    }

    public function scopeStatus($query, $status)
    {
        if ($status === 1) {
            return $query->where('start_schedule', '<=', now())
                ->where('end_schedule', '>=', now());
        } elseif ($status === 0) {
            return $query->where(function ($query) {
                $query->where('start_schedule', '>', now())
                    ->orWhere('end_schedule', '<', now());
            });
        } else {
            return $query;
        }
    }

    public function scopeContest($query, $contest)
    {
        return $contest ? $query->where('contest_id', $contest) : $query;
    }

    public function scopeStage($query, $stage)
    {
        return $stage ? $query->where('stage_id', $stage) : $query;
    }

    public function scopeDate($query, $date)
    {
        return $date ? $query->where('start_schedule', $date) : $query;
    }


    public function getResolutionIssuanceAttribute($value)
    {
        return Carbon::parse($value)->toDateString();
    }

    public function getStartScheduleAttribute($value)
    {
        return Carbon::parse($value)->toDateString();
    }

    public function getEndScheduleAttribute($value)
    {
        return Carbon::parse($value)->toDateString();
    }
}

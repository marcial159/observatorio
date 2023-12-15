<?php

namespace App\Exports;

use App\Models\Entity;
use App\Models\Event;
use App\Models\Transaction;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;
use DB;

class ReportThreeExport implements FromView, ShouldAutoSize
{
    use Exportable;

    public function Start($start)
    {
        $this->start = $start;
        return $this;
    }

    public function End($end)
    {
        $this->end = $end;
        return $this;
    }

    public function Entity($entity)
    {
        $this->entity = $entity;
        return $this;
    }
   
    public function List($list)
    {
        $this->list = $list;
        return $this;
    }

    public function Months($months)
    {
        $this->months = $months;
        return $this;
    }

    public function Coordinators($coordinators)
    {
        $this->coordinators = $coordinators;
        return $this;
    }

    public function view(): View
    {
        return view('pdf.reports.reportThree',[
            'list' => $this->list,
            'coordinators' => $this->coordinators,
            'start' => $this->start,
            'end' => $this->end,
            'months' => $this->months,
            'entity' => $this->entity,
        ]);
    }
}

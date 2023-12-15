<?php

namespace App\Exports;
use App\Models\Transaction;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;
use DB;

class ReportFiveExport implements FromView, ShouldAutoSize
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

    public function Rows($rows)
    {
        $this->rows = $rows;
        return $this;
    }

    public function Document($document)
    {
        $this->document = $document;
        return $this;
    }

    public function view(): View
    {
        return view('pdf.reports.reportFive',[
            'list' => $this->list,
            'months' => $this->months,
            'start' => $this->start,
            'end' => $this->end,
            'rows' => $this->rows,
            'document' => $this->document,
        ]);
    }
}

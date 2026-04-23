<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\NpsFeedback;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;

class ApexCharts extends Component
{
    public $labels = [];
    public $series = [];

    public $startDate;
    public $endDate;

    public function mount()
    {
        $this->startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->endDate = Carbon::now()->endOfMonth()->format('Y-m-d');

        ['labels' => $this->labels, 'series' => $this->series] = $this->getNpsData($this->startDate, $this->endDate);
    }

    // public function getDateRange($startDate = null, $endDate = null)
    // {
    //     $start = $startDate ? Carbon::parse($startDate) : now()->startOfMonth();
    //     $end = $endDate ? Carbon::parse($endDate) : now()->endOfMonth();

    //     return collect(CarbonPeriod::create($start, $end))
    //         ->map(fn($date) => $date->format('Y-m-d'))
    //         ->toArray();
    // }

    public function getNpsData($startDate, $endDate)
    {
        $rows = DB::table('nps_feedback')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date, nps, COUNT(*) as total')
            ->groupByRaw('DATE(created_at), nps')
            ->orderBy('date')
            ->orderBy('nps')
            ->get();

        $dates = $rows->pluck('date')->unique()->values()->toArray();
        $npsScores = $rows->pluck('nps')->unique()->sort()->values()->toArray();

        // Build series: one series per NPS score
        $series = collect($npsScores)->map(function ($score) use ($rows, $dates) {
            $dataByDate = $rows->where('nps', $score)->keyBy('date');
            return [
                'name' => 'NPS ' . $score,
                'data' => collect($dates)->map(fn($date) => $dataByDate[$date]->total ?? 0)->toArray()
            ];
        })->toArray();
// dd($series);
        return ['labels' => $dates, 'series' => $series];
    }

    public function chartFilter()
    {

    // dd($this->getNpsData($this->startDate, $this->endDate));

        ['labels' => $this->labels, 'series' => $this->series] =  $this->getNpsData($this->startDate, $this->endDate);
        $this->dispatch('updateChart', series: $this->series, labels: $this->labels);
    }

    public function render()
    {
        return view('livewire.apex-charts');
    }
}

<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\PeminjamanLaboratorium;

class LaporanPeminjamanLaboratoriumTable extends Component
{
    public $monthNavigation = 0;
    public $yearNavigation = 0;

    public function increaseMonthNavigation()
    {
        $this->monthNavigation = ($this->monthNavigation + now()->month == 12) ?
            $this->monthNavigation - (now()->month + ($this->monthNavigation % 12) - 1)
            : $this->monthNavigation + 1;
    }

    public function increaseYearNavigation()
    {
        $this->yearNavigation++;
    }

    public function decreaseMonthNavigation()
    {
        $this->monthNavigation = ($this->monthNavigation + now()->month <= 1) ?
            $this->monthNavigation + (now()->month + (12 % now()->month) - 1)
            : $this->monthNavigation - 1;
    }

    public function decreaseYearNavigation()
    {
        $this->yearNavigation--;
    }

    public function render()
    {
        setlocale(LC_TIME, 'id_ID');
        \Carbon\Carbon::setLocale('id');
        \Carbon\Carbon::now()->formatLocalized("%A, %d %B %Y");

        $numberOfMonth = $this->monthNavigation + now()->month;
        $numberOfYear = $this->yearNavigation + now()->year;

        $currentMonth = Carbon::create(date("Y"), $numberOfMonth);
        $totalDays = [];
        $scenario = ["laboratorium" => "", "jam" => []];
        $containerScenario = [];

        $peminjaman = PeminjamanLaboratorium::with("laboratorium")->whereMonth('created_at', $currentMonth->month)->whereYear('created_at', $numberOfYear)->select(
            DB::raw('DATE_FORMAT(created_at, "%d") as date'),
            'laboratorium_id',
            DB::raw('SUM(TIMESTAMPDIFF(MINUTE, pl_jam_mulai, pl_jam_akhir)) as total_minutes')
        )
            ->groupBy(DB::raw('DATE_FORMAT(created_at, "%d")'), 'laboratorium_id')
            ->get();



        for ($i = 1; $i <= $currentMonth->endOfMonth()->day; $i++) {
            $totalDays[] = $i;
            $jamTemp[] = 0;
        }

        $total_sum = 0;
        $results = [];
        foreach ($peminjaman as $row) {
            $total_sum += $row->total_minutes;
            if (!isset($results[$row->laboratorium_id])) {
                $results[$row->laboratorium_id] = [
                    "laboratorium" => $row->laboratorium->l_nama,
                    "jam" => array_fill(0, count($totalDays), 0),
                ];
            }
            $results[$row->laboratorium_id]['jam'][$row->date - 1] = $row->total_minutes;
        }

        foreach ($results as $result) {
            $containerScenario[] = $result;
        }

        $total_jam_baris = $jamTemp;
        for ($i = 0; $i < $currentMonth->endOfMonth()->day; $i++) {
            foreach ($containerScenario as $row) {
                if (isset($row["jam"][$i])) {
                    $total_jam_baris[$i] += $row["jam"][$i];
                } else {
                    $total_jam_baris[$i] += 0;
                }
            }
        }
        return view('livewire.laporan-peminjaman-laboratorium-table', [
            "totalDays" => $totalDays,
            "scenario" => $containerScenario,
            "total_baris" => $total_jam_baris,
            "month" => Carbon::createFromDate($numberOfYear, $numberOfMonth)->isoFormat("MMMM"),
            "year" => Carbon::createFromDate($numberOfYear, $numberOfMonth)->isoFormat("Y"),
        ]);
    }
}

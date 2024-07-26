<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use App\Models\PeminjamanInventaris;
use App\Models\PeminjamanLaboratorium;

class LaporanController extends Controller
{
    public function indexInventaris()
    {
        // $currentMonth = Carbon::create(date("Y"), now()->month);
        // $totalDays = [];
        // for ($i = 0; $i <= $currentMonth->endOfMonth()->day; $i++) {
        //     $totalDays[] = $i;
        // }

        // $p = PeminjamanInventaris::select(
        //     DB::raw('DATE(created_at) as date'),
        //     'laboratorium_id',
        //     DB::raw('SUM(TIMESTAMPDIFF(MINUTE, pi_jam_mulai, pi_jam_akhir)) as total_minutes')
        // )
        //     ->groupBy(DB::raw('DATE(created_at)'), 'laboratorium_id')
        //     ->get();

        // dd($totalDays, $p);

        PeminjamanInventaris::all();

        return view("admin.laporan_statistic.inventaris.lihat", [
            "title" => "Laporan",
            "action" => "laporan_inventaris",
        ]);
    }

    public function indexLaboratorium()
    {
        $currentMonth = Carbon::create(date("Y"), now()->month);
        $totalDays = [];
        $scenario = ["laboratorium" => "", "jam" => []];
        $containerScenario = [];

        $peminjaman = PeminjamanLaboratorium::with("laboratorium")->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->select(
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

        return view("admin.laporan_statistic.laboratorium.lihat", [
            "title" => "Laporan",
            "action" => "laporan_laboratorium",
            "totalDays" => $totalDays,
            "scenario" => $containerScenario,
            "total_baris" => $total_jam_baris,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestLaporanKerusakan;
use App\Models\LaporanKerusakan;
use Illuminate\Http\Request;

class LaporanKerusakanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.laporan.kerusakan.lihat", [
            "title" => "kerusakan",
            "action" => "kerusakan",
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.laporan.kerusakan.create", [
            "title" => "kerusakan",
            "action" => "kerusakan",
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RequestLaporanKerusakan $request)
    {
        $validation = $request->validated();

        try {
            
        } catch (\Throwable $th) {
            //throw $th;
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(LaporanKerusakan $laporanKerusakan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LaporanKerusakan $laporanKerusakan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LaporanKerusakan $laporanKerusakan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LaporanKerusakan $laporanKerusakan)
    {
        //
    }
}

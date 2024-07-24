<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanKerusakan;
use Illuminate\Support\Facades\Storage;
use App\DataTables\LaporanKerusakanDataTable;
use App\Http\Requests\RequestLaporanKerusakan;

class LaporanKerusakanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(LaporanKerusakanDataTable $data)
    {
        return $data->render("admin.laporan.kerusakan.lihat", [
            "title" => "kerusakan",
            "action" => "lihat pengajuan",
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.laporan.kerusakan.create", [
            "title" => "kerusakan",
            "action" => "tambah pengajuan",
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RequestLaporanKerusakan $request)
    {
        $validation = $request->validated();
        $validation["user_id"] = auth()->user()->id;

        try {
            $file_kerusakan = $request->file('lk_lampiran');
            $foto_kerusakan = $file_kerusakan->hashName();

            $foto_kerusakan_path = $file_kerusakan->storeAs("/kerusakan", $foto_kerusakan);
            $foto_kerusakan_path = Storage::disk("public")->put("/kerusakan", $file_kerusakan);
            $validation['lk_lampiran'] = $foto_kerusakan_path;

            LaporanKerusakan::create($validation);
        } catch (\Throwable $th) {
            return back()->with("error", "Ups! Gagal menambahkan laporan , Segera  hubungi admin");
        }

        return back()->with("success", "Berhasil Menambahkan");
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
        try {
            $laporanKerusakan->delete();
        } catch (\Throwable $th) {
            return back()->with("error", "Ups! Gagal menambahkan laporan , Segera  hubungi admin");
        }

        return back()->with("success", "Berhasil menghapus laporan kerusakan");
    }
}

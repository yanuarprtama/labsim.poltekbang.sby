<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PeminjamanInventaris;
use App\DataTables\PeminjamanInventarisDataTable;
use App\DataTables\PeminjamanLaboratoriumDataTable;
use App\Models\PeminjamanLaboratorium;

class PeminjamanController extends Controller
{
    public function indexInventaris(PeminjamanInventarisDataTable $data)
    {
        return $data->render("admin.peminjaman.daftar_peminjaman.inventaris.lihat", [
            "title" => "Peminjaman",
            "action" => "daftar_inventaris",
        ]);
    }

    public function indexLaboratorium(PeminjamanLaboratoriumDataTable $data)
    {
        return $data->render("admin.peminjaman.daftar_peminjaman.laboratorium.lihat", [
            "title" => "Peminjaman",
            "action" => "daftar_laboratorium",
        ]);
    }

    public function updateStatusTerima($id, $type)
    {
        try {
            if ($type == "laboratorium") {
                PeminjamanLaboratorium::whereId($id)->update([
                    "pl_status" => "DITERIMA"
                ]);
            } else {
                PeminjamanInventaris::whereId($id)->update([
                    "pi_status" => "DITERIMA",
                ]);
            }
        } catch (\Exception $th) {
            return back()->with("error", "Ups ada yang salah ni");
        }
        return back()->with("success", "berhasil");
    }
    public function updateStatusTolak($id, $type)
    {
        try {
            if ($type == "laboratorium") {
                PeminjamanLaboratorium::whereId($id)->update([
                    "pl_status" => "DITOLAK"
                ]);
            } else {
                PeminjamanInventaris::whereId($id)->update([
                    "pi_status" => "DITOLAK",
                ]);
            }
        } catch (\Exception $th) {
            return back()->with("error", "Ups ada yang salah ni");
        }
        return back()->with("success", "berhasil");
    }
}

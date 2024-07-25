<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\KritikSaranInventaris;
use App\Models\KritikSaranLaboratorium;
use App\Models\PeminjamanInventaris;
use App\Models\PeminjamanLaboratorium;

class KritikSaranController extends Controller
{
    public function store(Request $request)
    {
        try {
            if ($request->type == "inventaris") {
                DB::transaction(function () use ($request) {
                    KritikSaranInventaris::create($request->all());

                    PeminjamanInventaris::whereId($request->peminjaman_inventaris_id)->update([
                        "pi_status" => "DIKEMBALIKAN",
                    ]);
                });
            } else if ($request->type == "laboratorium") {
                DB::transaction(function () use ($request) {
                    KritikSaranLaboratorium::create($request->all());

                    PeminjamanLaboratorium::whereId($request->peminjaman_laboratorium_id)->update([
                        "pl_status" => "DIKEMBALIKAN",
                    ]);
                });
            }
        } catch (\Exception $th) {
            return response()->json([
                "error" => true,
                "message" => "Internal Error"
            ], 505);
        }

        return response()->json([
            "error" => false,
            "message" => "Berhasil mengembalikan"
        ]);
    }
}

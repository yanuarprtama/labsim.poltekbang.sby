<?php

namespace App\Http\Controllers\Api;

use App\Models\Laboratorium;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Inventaris;

class ApiController extends Controller
{
    public function inventarisData($id)
    {
        try {
            $laboratorium = Laboratorium::whereId($id)->get();
        } catch (\Exception $th) {
            return response()->json([
                "error" => true,
                "message" => "Internal Error"
            ], 500);
        }

        return response()->json([
            "error" => false,
            "data" => $laboratorium->load('inventaris')[0]->inventaris
        ], 200);
    }

    public function checkQty($id, $qty)
    {
        try {
            $qty_check = Inventaris::whereId($id)->where("a_stok", "<", $qty);

            return $qty_check->exists() ? response()->json([
                "error" => true,
                "message" => "Stok " . $qty_check->first()->a_nama . " tidak mencukupi,mohon diisi kurang dari " . $qty_check->first()->a_stok + 1
            ], 403) : response()->json([
                "error" => false,
                "message" => "berhasil"
            ]);
        } catch (\Exception $th) {
            return response()->json([
                "error" => true,
                "message" => "Internal Error"
            ], 505);
        }
    }
}

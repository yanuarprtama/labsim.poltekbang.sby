<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\PeminjamanInventaris;
use App\Models\PeminjamanLaboratorium;
use App\Models\DetailPeminjamanInventaris;
use App\Services\peminjaman\laboratorium\laboratoriumService;

class HomeController extends Controller
{
    private $laboratoriumService;

    public function __construct(laboratoriumService $laboratoriumService)
    {
        $this->laboratoriumService = $laboratoriumService;
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home', [
            "title" => "Data Pokok",
            "action" => "Transaksi"
        ]);
    }

    public function storeInventaris(Request $request)
    {
        try {

            if ($request->inventaris == null)
                return response()->json([
                    "error" => true,
                    "message" => "Belum memasukkan inventaris"
                ], 403);
            $transaksi = DB::transaction(function () use ($request) {
                $peminjaman = PeminjamanInventaris::create([
                    "pi_nomor_peminjaman" => now() . "#INVENTARIS",
                    "pi_jam_mulai" => $request->pi_jam_mulai,
                    "pi_jam_akhir" => $request->pi_jam_akhir,
                    "user_id" => auth()->user()->id,
                ]);

                foreach ($request->inventaris as $item) {
                    $inventaris = Inventaris::whereId($item["id"])->first();
                    if ($inventaris->a_stok < $item["qty"]) {
                        return response()->json([
                            "error" => true,
                            "message" => $inventaris->a_nama . " stok tidak mencukupi",
                        ], 403);
                    }
                    DetailPeminjamanInventaris::create([
                        "inventaris_id" => $item["id"],
                        "peminjaman_inventaris_id" => $peminjaman->id,
                        "dpi_qty" => $item["qty"],
                    ]);
                }
            });

            if ($transaksi)
                return $transaksi;
        } catch (\Exception $th) {
            return response()->json([
                "error" => true,
                "message" => "Internal Error",
            ], 505);
        }

        return response()->json([
            "error" => false,
            "message" => "Peminjaman berhasil"
        ]);
    }
    public function storeLaboratorium(Request $request)
    {
        try {
            $check = $this->laboratoriumService->validateSchedule($request->pl_jam_mulai, $request->pl_jam_mulai, $request->laboratorium_id);
            if ($check)
                return response()->json([
                    "error" => true,
                    "message" => "Jadwal sudah ada, Silakan ganti jadwal"
                ], 403);
            $peminjaman = PeminjamanLaboratorium::create([
                "pl_nomor_peminjaman" => now() . "#LABORATORIUM",
                "pl_mata_kuliah" => $request->pl_mata_kuliah,
                "pl_jenis_kegiatan" => $request->pl_jenis_kegiatan,
                "pl_jam_mulai" => $request->pl_jam_mulai,
                "pl_jam_akhir" => $request->pl_jam_akhir,
                "pl_dosen_pengajar" => $request->pl_dosen_pengajar,
                "laboratorium_id" => $request->laboratorium_id,
                "user_id" => auth()->user()->id,
            ]);
        } catch (\Exception $th) {
            return  response()->json([
                "error" => true,
                "message" => "Internal Error"
            ], 505);
        }

        return response()->json([
            "error" => false,
            "message" => "Peminjaman" . $peminjaman->pl_nomor_peminjaman . " berhasil"
        ]);
    }

    public function peminjamanInventarisHistory($type_peminjaman)
    {
        try {
            if ($type_peminjaman == "inventaris") {
                $peminjaman = PeminjamanInventaris::with("inventaris.laboratorium")->whereUserId(auth()->user()->id)->latest()->get();
            } else if ($type_peminjaman == "laboratorium") {
                $peminjaman = PeminjamanLaboratorium::with("laboratorium")->whereUserId(auth()->user()->id)->latest()->get();
            }
        } catch (\Exception $th) {
            return response()->json([
                "error" => true,
                "data" => "Internal Error"
            ], 505);
        }

        return response()->json([
            "error" => false,
            "data" => $peminjaman
        ]);
    }

    public function peminjamanBatal(Request $request)
    {
        try {
            if ($request->type_peminjaman == "inventaris") {
                PeminjamanInventaris::whereId($request->id)->update([
                    "pi_status" => "DIBATALKAN",
                ]);
            } else if ($request->type_peminjaman == "laboratorium") {
                PeminjamanLaboratorium::whereId($request->id)->update([
                    "pl_status" => "DIBATALKAN",
                ]);
            }
        } catch (\Exception $th) {
            return response()->json([
                "error" => true,
                "message" => "Internal Error"
            ], 505);
        }

        return response()->json([
            "error" => false,
            "message" => "Berhasil membatalkan"
        ]);
    }
}

<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\KritikSaranController;
use App\Http\Controllers\LaboratoriumController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LaporanKerusakanController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\ProdiController;
use App\Models\Laboratorium;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(HomeController::class)->group(function () {
    Route::group(["as" => "peminjaman.", "middleware" => "auth"], function () {
        Route::get("/", "index")->name("index");

        Route::post("peminjaman/inventaris/action", "storeInventaris")->name("inventaris.action");
        Route::post("peminjaman/laboratorium/action", "storeLaboratorium")->name("laboratorium.action");

        Route::get("riwayat/{type_peminjaman}", "peminjamanInventarisHistory")->name("peminjaman.riwayat");
        Route::post("peminjaman/batal", "peminjamanBatal")->name("peminjaman.cancel");
    });
});

Route::controller(KritikSaranController::class)->group(function () {
    Route::group(["prefix" => "kritik-saran", "as" => "kritikSaran.", "middleware" => "auth"], function () {
        Route::post("/store", "store");
    });
});

Route::group(["prefix" => "admin", "middleware" => ["admin", "auth"]], function () {

    /**
     * Prodi Route
     */
    Route::controller(ProdiController::class)->group(function () {
        Route::group(["prefix" => "prodi", "as" => "prodi.", "middleware" => "auth"], function () {
            Route::get("", "index")->name("index");
            Route::get("data", "data")->name("data");
            Route::get("show/{slug}", "show")->name("show");

            Route::get("create", "create")->name("create");
            Route::post("store", "store")->name("store");

            Route::get("edit/{prodi}", "edit")->name("edit");
            Route::put("update/{prodi}", "update")->name("update");
            Route::put("update/status/{prodi}", "update_status")->name("update.status");


            Route::delete("delete/{prodi}", "destroy")->name("delete");
        });
    });

    /**
     * Laboratorium Route
     */
    Route::controller(LaboratoriumController::class)->group(function () {
        Route::group(["prefix" => "laboratorium", "as" => "laboratorium.", "middleware" => "auth"], function () {
            Route::get("", "index")->name("index");

            Route::get("data", "data")->name("data");
            Route::get("{slug}/inventaris", "inventaris")->name("inventaris");

            Route::get("show/{slug}", "show")->name("show");

            Route::get("create", "create")->name("create");
            Route::post("store", "store")->name("store");
            Route::get("edit/{laboratorium}", "edit")->name("edit");
            Route::put("update/{laboratorium}", "update")->name("update");
            Route::delete("delete/{laboratorium}", "destroy")->name("delete");
        });
    });

    /**
     * Inventaris Route
     */
    Route::controller(InventarisController::class)->group(function () {
        Route::group(["prefix" => "inventaris", "as" => "inventaris.", "middleware" => "auth"], function () {
            Route::get("", "index")->name("index");

            Route::get("data", "data")->name("data");

            Route::get("show/{inventaris}", "show")->name("show");

            Route::get("create", "create")->name("create");
            Route::post("store", "store")->name("store");

            Route::get("edit/{inventaris}", "edit")->name("edit");
            Route::put("update/{inventaris}", "update")->name("update");
            Route::put("stok/{inventaris}", "update_stok")->name("stok");

            Route::delete("delete/{inventaris}", "destroy")->name("delete");
        });
    });

    /**
     * Laporan Route
     */
    Route::controller(LaporanKerusakanController::class)->group(function () {
        Route::group(["prefix" => "laporan/pengajuan", "as" => "laporan.", "middleware" => "auth"], function () {
            Route::group(["prefix" => "kerusakan", "as" => "kerusakan."], function () {
                Route::get("", "index")->name("index");
                // Tambah Kerusakan
                Route::get("create", "create")->name("create");
                Route::post("store", "store")->name("store");
                // Delete Kerusakan
                Route::delete("delete/laporanKerusakan", "destroy")->name("delete");
            });
        });
    });

    /**
     * Peminjaman
     */
    Route::controller(PeminjamanController::class)->group(function () {
        Route::group(["prefix" => "peminjaman", "as" => "daftarPeminjaman."], function () {
            Route::get("inventaris", "indexInventaris")->name("inventaris");
            Route::get("laboratorium", "indexLaboratorium")->name("laboratorium");
            Route::get("status/terima/{id}/{type}", "updateStatusTerima")->name("status.terima");
            Route::get("status/tolak/{id}/{type}", "updateStatusTolak")->name("status.tolak");
        });
    });

    /**
     * Laporan
     */
    Route::controller(LaporanController::class)->group(function () {
        Route::group(["prefix" => "laporan", "as" => "laporan.statik."], function () {
            Route::get("inventaris", "indexInventaris")->name("inventaris");
            Route::get("laboratorium", "indexLaboratorium")->name("laboratorium");
        });
    });
});

Auth::routes();

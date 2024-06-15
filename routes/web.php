<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\LaboratoriumController;
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

Route::get('/', function () {
    return view('welcome', [
        "title" => "Data Pokok",
        "action" => "Transaksi"
    ]);
});

Route::controller(ProdiController::class)->group(function () {
    Route::group(["prefix" => "prodi", "as" => "prodi."], function () {
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

Route::controller(LaboratoriumController::class)->group(function () {
    Route::group(["prefix" => "laboratorium", "as" => "laboratorium."], function () {
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

Route::controller(InventarisController::class)->group(function () {
    Route::group(["prefix" => "inventaris", "as" => "inventaris."], function () {
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

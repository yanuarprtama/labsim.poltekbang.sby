<?php

namespace App\Http\Controllers;

use App\DataTables\InventarisDataTable;
use App\Http\Requests\RequestInventaris;
use App\Models\Inventaris;
use App\Models\Laboratorium;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class InventarisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(InventarisDataTable $data)
    {
        return $data->render("admin.inventaris.lihat", [
            "title" => "Inventaris",
            "action" => "Inventaris",
            "laboratorium" => Laboratorium::all(),
        ]);
    }

    public function data()
    {
        $inventaris = Inventaris::join("laboratoriums", "inventaris.laboratorium_id", "=", "laboratoriums.id");

        return DataTables::of($inventaris)
            ->addColumn("edit", "admin.inventaris.component.action")
            ->only(["l_nama", "a_nama", "a_kode", "a_stok", "edit"])
            ->rawColumns(["edit", "laboratorium"])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.inventaris.create", [
            "title" => "Inventaris",
            "action" => "Inventaris",
            "laboratorium" => Laboratorium::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RequestInventaris $request)
    {
        $validation = $request->validated();
        $base_url = explode("/", url()->previous())[3];

        // try {
        $data = Inventaris::create($validation);
        // } catch (\Exception $th) {
        //     return back()->withInput()->with("error", "Ups ada yang salah !");
        // }
        if ($base_url == "laboratorium") {
            return back()->with("success", "Berhasil menambahkan " . $data["a_nama"]);
        }
        return redirect()->route("inventaris.index")->withInput()->with("success", "Berhasil menambahkan " . $data["a_nama"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventaris $inventaris)
    {
        return view("admin.inventaris.show", [
            "title" => "Inventaris",
            "action" => "Inventaris",
            "inventaris" => $inventaris,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventaris $inventaris)
    {
        return view("admin.inventaris.edit", [
            "title" => "Inventaris",
            "action" => "Inventaris",
            "inventaris" => $inventaris,
            "laboratorium" => Laboratorium::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RequestInventaris $request, Inventaris $inventaris)
    {
        $validation = $request->validated();

        try {
            $data = $inventaris->update($validation);
        } catch (\Exception $th) {
            return back()->withInput()->with("error", "Ups ada yang salah !");
        }
        return back()->withInput()->with("success", "Berhasil memperbarui");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_stok(Request $request, Inventaris $inventaris)
    {
        try {
            $data = $inventaris->update([
                "stok" => $request->a_stok
            ]);
        } catch (\Exception $th) {
            return back()->withInput()->with("error", "Ups ada yang salah !");
        }
        return back()->withInput()->with("success", "Berhasil memperbarui Stok " . $inventaris->a_nama . " dari " . $inventaris->a_stok . " menjadi " . $request->a_stok);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventaris $inventaris)
    {
        try {
            $data = $inventaris->delete();
        } catch (\Exception $th) {
            return back()->withInput()->with("error", "Ups ada yang salah !");
        }
        return back()->withInput()->with("success", "Berhasil menghapus");
    }
}

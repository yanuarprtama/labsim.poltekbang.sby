<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Support\Str;
use App\Models\Laboratorium;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\DataTables\LaboratoriumDataTable;
use App\Http\Requests\RequestLaboratorium;
use App\Models\Inventaris;

class LaboratoriumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(LaboratoriumDataTable $data)
    {
        return $data->render("admin.laboratorium.lihat", [
            "title" => "Laboratorium",
            "action" => "Laboratorium",
        ]);
    }

    public function data()
    {
        $laboratorium = Laboratorium::with("prodi");
        return DataTables::of($laboratorium)
            ->addColumn("edit", "admin.laboratorium.component.action")
            ->rawColumns(["edit"])

            ->make(true);
    }

    public function inventaris($slug)
    {
        $laboratorium = Laboratorium::whereLSlug($slug)->first();
        $inventaris = Inventaris::whereLaboratoriumId($laboratorium->id);
        return DataTables::of($inventaris)
            ->addColumn("edit", "admin.inventaris.component.action")
            ->rawColumns(["edit"])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.laboratorium.create", [
            "title" => "Laboratorium",
            "action" => "Laboratorium",
            "prodi" => Prodi::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RequestLaboratorium $request)
    {
        $validation = $request->validated();
        try {
            $data = Laboratorium::create($validation + Str::slug($validation["l_nama"]));
        } catch (\Exception $th) {
            return back()->withInput()->with("error", "Ups ada yang salah !");
        }
        return redirect()->route("laboratorium.index")->withInput()->with("success", "Berhasil menambahkan " . $data["l_nama"]);
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $laboratorium = Laboratorium::whereLSlug($slug)->first();
        return view("admin.laboratorium.show", [
            "title" => "Laboratorium",
            "action" => "Laboratorium",
            "laboratorium" => $laboratorium->load("inventaris")
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Laboratorium $laboratorium)
    {
        return view("admin.laboratorium.edit", [
            "title" => "Laboratorium",
            "action" => "Laboratorium",
            "laboratorium" => $laboratorium->load("prodi"),
            "prodi" => Prodi::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RequestLaboratorium $request, Laboratorium $laboratorium)
    {
        $validation = $request->validated();
        $validation["l_slug"] = Str::slug($validation["l_nama"]);
        try {
            $data = $laboratorium->update($validation);
        } catch (\Exception $th) {
            return back()->withInput()->with("error", "Ups ada yang salah !");
        }
        return back()->with("success", "Berhasil memperbarui");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Laboratorium $laboratorium)
    {
        try {
            $data = $laboratorium->delete();
        } catch (\Exception $th) {
            return back()->withInput()->with("error", "Ups ada yang salah !");
        }
        return back()->withInput()->with("success", "Berhasil menghapus");
    }
}

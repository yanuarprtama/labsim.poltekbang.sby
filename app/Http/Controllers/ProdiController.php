<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Support\Str;
use App\DataTables\ProdiDataTable;
use App\Http\Requests\RequestProdi;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProdiDataTable $data)
    {
        return $data->render("admin.prodi.lihat", [
            "title" => "Prodi",
            "action" => "Prodi",
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.prodi.create", [
            "title" => "Prodi",
            "action" => "Prodi",
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RequestProdi $request)
    {
        $validation = $request->validated();

        $validation["p_slug"] = Str::slug($validation["p_nama"]);

        try {
            $data = Prodi::create($validation);
        } catch (\Exception $th) {
            return back()->withInput()->with("error", "Ups ada yang salah !");
        }
        return redirect()->route("prodi.index")->with("success", "Berhasil menambahkan " . $data["p_nama"]);
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        return view("admin.prodi.show", [
            "title" => "Prodi",
            "action" => "Prodi",
            "prodi" => Prodi::wherePSlug($slug)->first(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prodi $prodi)
    {
        return view("admin.prodi.edit", [
            "title" => "Prodi",
            "action" => "Prodi",
            "prodi" => $prodi::first(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RequestProdi $request, Prodi $prodi)
    {
        $validation = $request->validated();

        try {
            $data = $prodi->update($validation);
        } catch (\Exception $th) {
            return back()->withInput()->with("error", "Ups ada yang salah !");
        }
        return back()->with("success", "Berhasil memperbarui ");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_status(Prodi $prodi)
    {
        if ($prodi->status == "aktif") {
            $status = "non_aktif";
        } else {
            $status = "aktif";
        }

        try {
            $data = $prodi->update([
                "status" => $status
            ]);
        } catch (\Exception $th) {
            return back()->withInput()->with("error", "Ups ada yang salah !");
        }
        return back()->with("success", "Berhasil memperbarui status " . $prodi->p_nama . " menjadi " . ucwords(str_replace("_", "", $status)));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prodi $prodi)
    {
        try {
            $data = $prodi->delete();
        } catch (\Exception $th) {
            return back()->withInput()->with("error", "Ups ada yang salah !");
        }
        return redirect()->route("prodi.index")->with("success", "Berhasil menghapus ");
    }
}

<?php

namespace App\Services\peminjaman\laboratorium;

use App\Models\PeminjamanLaboratorium;

class laboratoriumServiceImplement implements laboratoriumService
{
    private $peminjamanLaboratoriumModel;

    public function __construct(PeminjamanLaboratorium $laboratorium)
    {
        $this->peminjamanLaboratoriumModel = $laboratorium;
    }

    public function validateSchedule($start, $end, $idLaboratorium)
    {
        return $this->peminjamanLaboratoriumModel::whereLaboratoriumId($idLaboratorium)->where(function ($q) use ($start) {
            $q->where("pl_jam_mulai", "<=", $start)->where("pl_jam_akhir", ">=", $start);
        })->orWhere(function ($q) use ($end) {
            $q->where("pl_jam_akhir", ">=", $end)->where("pl_jam_mulai", "<=", $end);
        })->whereDay("created_at", now()->day)->exists();
    }
}

<?php

namespace App\Services\peminjaman\laboratorium;

interface laboratoriumService
{
    public function validateSchedule($start, $end, $idLaboratorium);
}

<?php

namespace App\Livewire;

use App\Models\Laboratorium;
use Livewire\Component;

class PeminjamanHome extends Component
{
    public $navigation = 1;

    public function render()
    {
        
        return view('livewire.peminjaman-home', [
            "laboratorium" => Laboratorium::all()
        ]);
    }
}

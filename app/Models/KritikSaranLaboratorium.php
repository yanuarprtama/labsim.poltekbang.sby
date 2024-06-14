<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KritikSaranLaboratorium extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'peminjaman_laboratorium_id',
        'ks_kritik',
        'ks_saran',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'peminjaman_laboratorium_id' => 'integer',
    ];

    public function peminjamanLaboratorium(): BelongsTo
    {
        return $this->belongsTo(PeminjamanLaboratorium::class);
    }
}

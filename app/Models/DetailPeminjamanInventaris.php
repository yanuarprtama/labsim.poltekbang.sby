<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailPeminjamanInventaris extends Pivot
{
    use HasFactory;

    protected $table = "detail_peminjaman_inventaris";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'peminjaman_inventaris_id',
        'inventaris_id',
        'dpi_qty',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'peminjaman_inventaris_id' => 'integer',
        'inventaris_id' => 'integer',
    ];

    public function inventaris(): BelongsTo
    {
        return $this->belongsTo(Inventaris::class);
    }

    public function peminjamanInventaris(): BelongsTo
    {
        return $this->belongsTo(PeminjamanInventaris::class);
    }
}

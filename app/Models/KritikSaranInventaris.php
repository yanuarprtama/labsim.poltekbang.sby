<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KritikSaranInventaris extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'peminjaman_inventaris_id',
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
        'peminjaman_inventaris_id' => 'integer',
    ];

    public function peminjamanInventaris(): BelongsTo
    {
        return $this->belongsTo(PeminjamanInventaris::class);
    }
}

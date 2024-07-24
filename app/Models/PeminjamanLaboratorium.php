<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PeminjamanLaboratorium extends Model
{
    use HasFactory;

    protected $table = "peminjaman_laboratoriums";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pl_nomor_peminjaman',
        'pl_mata_kuliah',
        'pl_jenis_kegiatan',
        'pl_jam_mulai',
        'pl_jam_akhir',
        'pl_dosen_pengajar',
        'pl_status',
        'laboratorium_id',
        'user_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'laboratorium_id' => 'integer',
        'user_id' => 'integer',
    ];

    public function kritikSaranLaboratorium(): HasOne
    {
        return $this->hasOne(KritikSaranLaboratorium::class);
    }

    public function laboratorium(): BelongsTo
    {
        return $this->belongsTo(Laboratorium::class, "laboratorium_id");
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

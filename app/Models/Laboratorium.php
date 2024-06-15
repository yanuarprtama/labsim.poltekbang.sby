<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Laboratorium extends Model
{
    use HasFactory;

    protected $table = "laboratoriums";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'l_nama',
        'l_slug',
        'l_jenis',
        'l_status',
        'prodi_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'prodi_id' => 'integer',
    ];

    public function inventaris(): HasMany
    {
        return $this->hasMany(Inventaris::class);
    }

    public function peminjamanLaboratorium(): HasMany
    {
        return $this->hasMany(PeminjamanLaboratorium::class);
    }

    public function prodi(): BelongsTo
    {
        return $this->belongsTo(Prodi::class);
    }
}

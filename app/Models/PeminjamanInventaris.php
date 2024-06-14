<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PeminjamanInventaris extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pi_nomor_peminjaman',
        'pi_jam_mulai',
        'pi_jam_akhir',
        'pi_status',
        'user_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
    ];

    public function inventaris(): BelongsToMany
    {
        return $this->belongsToMany(Inventaris::class);
    }

    public function detailPeminjamanInventaris(): HasOne
    {
        return $this->hasOne(DetailPeminjamanInventaris::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

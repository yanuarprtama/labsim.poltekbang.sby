<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('peminjaman_inventaris', function (Blueprint $table) {
            $table->id();
            $table->string('pi_nomor_peminjaman');
            $table->time('pi_jam_mulai');
            $table->time('pi_jam_akhir');
            $table->enum('pi_status', ["DITERIMA", "PROSES", "DITOLAK", "DIBATALKAN", "DIKEMBALIKAN", "DIPROSES"])->default("DIPROSES");
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman_inventaris');
    }
};

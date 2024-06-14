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

        Schema::create('peminjaman_laboratoria', function (Blueprint $table) {
            $table->id();
            $table->string('pl_nomor_peminjaman');
            $table->text('pl_mata_kuliah');
            $table->enum('pl_jenis_kegiatan', ["penelitian","praktikum"]);
            $table->time('pl_jam_mulai');
            $table->time('pl_jam_akhir');
            $table->string('pl_dosen_pengajar');
            $table->enum('pl_status', ["DITERIMA","KADALUARSA","DITOLAK","DIBATALKAN","DIKEMBALIKAN"]);
            $table->foreignId('laboratorium_id')->constrained();
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
        Schema::dropIfExists('peminjaman_laboratoria');
    }
};

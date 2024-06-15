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

        Schema::create('detail_peminjaman_inventaris', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peminjaman_inventaris_id')->constrained('peminjaman_inventaris');
            $table->foreignId('inventaris_id')->constrained('inventaris');
            $table->integer('dpi_qty');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_peminjaman_inventaris');
    }
};

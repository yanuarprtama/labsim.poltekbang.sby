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

        Schema::create('kritik_saran_laboratoriums', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peminjaman_laboratorium_id')->constrained();
            $table->text('ks_kritik');
            $table->text('ks_saran');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kritik_saran_laboratoria');
    }
};

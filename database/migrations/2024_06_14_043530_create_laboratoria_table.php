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

        Schema::create('laboratoria', function (Blueprint $table) {
            $table->id();
            $table->string('l_nama');
            $table->enum('l_jenis', ["laboratorium","simulator"]);
            $table->enum('l_status', ["aktif","non_aktif"]);
            $table->foreignId('prodi_id')->constrained();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laboratoria');
    }
};

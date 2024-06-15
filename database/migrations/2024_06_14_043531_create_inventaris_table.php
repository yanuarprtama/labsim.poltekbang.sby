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

        Schema::create('inventaris', function (Blueprint $table) {
            $table->id();
            $table->string('a_nama')->unique();
            $table->string('a_kode');
            $table->integer('a_stok');
            $table->enum('a_status', ["tersedia", "tidak"])->default("tersedia");
            $table->foreignId('laboratorium_id')->constrained("laboratoriums");
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventaris');
    }
};

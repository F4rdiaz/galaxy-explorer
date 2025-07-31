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
        Schema::create('missions', function (Blueprint $table) {
            $table->id();
            $table->string('nama_misi');
            $table->year('tahun_peluncuran');
            $table->year('tahun_kembali')->nullable();
            $table->string('tujuan');
            $table->text('keterangan');
            $table->json('astronot'); // 
            $table->enum('status', ['belum', 'sedang', 'selesai'])->default('belum');
            $table->timestamp('waktu_laporan')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('missions');
    }
};

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
    Schema::create('peminjaman', function (Blueprint $table) {
        $table->id();
        $table->foreignId('alat_id')->constrained('alats')->cascadeOnDelete();
        $table->string('nama_peminjam');
        $table->unsignedInteger('jumlah');
        $table->date('tanggal_pinjam');
        $table->date('tanggal_kembali')->nullable();
        $table->timestamps();
    });
    }

    public function down(): void
    {
    Schema::dropIfExists('peminjaman');
    }
};

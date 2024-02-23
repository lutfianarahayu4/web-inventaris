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
            $table->unsignedBigInteger('id_siswa');
            $table->foreign('id_siswa')->references('id')->on('siswas')->onDelete('cascade');
            $table->unsignedBigInteger('id_barang');
            $table->foreign('id_barang')->references('id')->on('barangs')->onDelete('cascade');
            $table->string('gambar');
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali');
            $table->text('kondisi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};

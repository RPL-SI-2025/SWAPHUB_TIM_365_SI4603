<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('barang')) {
            Schema::create('barang', function (Blueprint $table) {
                $table->id('id_barang');
                $table->foreignId('id_user')->references('id')->on('users')->onDelete('cascade');
                $table->foreignId('id_kategori')->references('id_kategori')->on('kategori')->onDelete('cascade');
                $table->string('nama_barang');
                $table->text('deskripsi_barang');
                $table->enum('status_barang', ['tersedia', 'tidak tersedia', 'ditukar']);
                $table->string('gambar')->nullable();
                $table->unsignedInteger('jumlah_klik')->default(0);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};

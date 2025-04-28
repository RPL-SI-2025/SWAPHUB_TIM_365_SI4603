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
                // Foreign key ke users.id
                $table->unsignedBigInteger('id_user');
                $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
                // Foreign key ke kategori.id_kategori
                $table->foreignId('id_kategori')->constrained('kategori')->onDelete('cascade');
                $table->string('nama_barang');
                $table->text('deskripsi_barang');
                $table->enum('status_barang', ['tersedia', 'ditukar', 'dihapus']);
                $table->string('kategori');
                $table->string('gambar')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};

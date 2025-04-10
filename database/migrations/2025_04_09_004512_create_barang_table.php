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
                $table->engine = 'InnoDB';
                $table->id('id_barang');
                $table->foreignId('id_user')->constrained('id', 'users')->onDelete('cascade');
                $table->foreignId('id_kategori')->constrained('kategori', 'id_kategori')->onDelete('cascade');
                $table->string('nama_barang');
                $table->text('deskripsi_barang');
                $table->string('status_barang');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};

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
                $table->foreignId('id_user')->constrained('users', 'id')->onDelete('cascade');
                $table->string('nama_barang');
                $table->text('deskripsi_barang');
                $table->enum('status_barang', ['tersedia', 'ditukar', 'dihapus']);
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

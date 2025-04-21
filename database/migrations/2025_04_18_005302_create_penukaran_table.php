<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penukaran', function (Blueprint $table) {
            $table->id('id_penukaran');
            $table->foreignId('id_penawar')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_ditawar')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_barang_penawar')->constrained('barang', 'id_barang')->onDelete('cascade');
            $table->foreignId('id_barang_ditawar')->constrained('barang', 'id_barang')->onDelete('cascade');
            $table->text('pesan_penukaran')->nullable();
            $table->enum('status_penukaran', ['pending', 'diterima', 'ditolak'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penukaran');
    }
};
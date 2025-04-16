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
            $table->foreignId('id_mahasiswa')->constrained('users', 'id')->onDelete('cascade'); // Requester
            $table->foreignId('id_barang')->constrained('barang', 'id_barang')->onDelete('cascade'); // Requested item
            $table->foreignId('id_barang_ditawarkan')->constrained('barang', 'id_barang')->onDelete('cascade'); // Offered item
            $table->string('riwayat_penukaran')->nullable(); // History or message
            $table->enum('status_penukaran', ['pending', 'diterima', 'ditolak'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penukaran');
    }
};

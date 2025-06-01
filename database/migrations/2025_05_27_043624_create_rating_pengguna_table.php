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
        Schema::create('rating_pengguna', function (Blueprint $table) {
            $table->id('id_rating_pengguna');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_penukaran_barang');
            $table->tinyInteger('rating')->unsigned(); // biasanya rating dari 1-5
            $table->text('review')->nullable();
            $table->enum('rating_type', ['penawar', 'ditawar']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rating_pengguna');
    }
};

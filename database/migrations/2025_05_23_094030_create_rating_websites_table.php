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
        Schema::create('rating_websites', function (Blueprint $table) {
            $table->id('id_rating_website');
            $table->unsignedBigInteger('id_user');
            $table->text('review');
            $table->tinyInteger('rating')->unsigned()->comment('Rating 1-5 stars');
            $table->text('tanggapan_review')->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            
            // Index for better performance
            $table->index(['id_user', 'rating']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rating_websites');
    }
};
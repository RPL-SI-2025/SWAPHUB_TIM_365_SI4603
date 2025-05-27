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
        Schema::create('admin_replies', function (Blueprint $table) {
        $table->id();
        $table->foreignId('rating_id')->constrained()->onDelete('cascade'); // balas rating tertentu
        $table->foreignId('admin_id')->constrained('users'); // yang balas adalah user tipe admin
        $table->text('reply_text');
        $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_replies');
    }
};

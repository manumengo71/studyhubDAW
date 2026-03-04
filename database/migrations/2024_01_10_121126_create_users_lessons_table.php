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
        Schema::create('users_lessons', function (Blueprint $table) {
            $table->id();
            $table->integer('users_id');
            $table->foreignId('lessons_id')->constrained('lessons')->onDelete('cascade');
            $table->foreignId('users_courses_id')->constrained('users_courses')->onDelete('cascade');
            $table->boolean('read')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_lessons');
    }
};

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
        Schema::create('lecturer_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('religion_id')->nullable();
            $table->string('nip')->unique()->nullable();
            $table->string('nidn')->unique()->nullable();
            $table->string('status')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('lecturer_status')->nullable();
            $table->string('is_active')->default(1)->nullable();
            $table->string('faculty')->nullable();
            $table->string('study_program')->nullable();
            $table->date('birthday')->nullable();
            $table->text('description')->nullable();
            $table->text('topic')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('religion_id')->references('id')->on('religions')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lecturer_users');
    }
};

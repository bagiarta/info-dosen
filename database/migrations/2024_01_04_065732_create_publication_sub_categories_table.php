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
        Schema::create('publication_sub_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('publication_category_id');
            $table->string('name');
            $table->timestamps();
            $table->foreign('publication_category_id')->references('id')->on('publication_categories')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publication_sub_categories');
    }
};

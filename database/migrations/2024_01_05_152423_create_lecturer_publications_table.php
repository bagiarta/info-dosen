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
        Schema::create('lecturer_publications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('publication_category_id');
            $table->unsignedBigInteger('publication_sub_category_id');
            $table->string('author');
            $table->string('title');
            $table->string('file')->nullable();
            $table->date('published_at');
            $table->string('published_in');
            $table->string('url');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('publication_category_id','pub_cat_id')->references('id')->on('publication_categories')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('publication_sub_category_id')->references('id')->on('publication_sub_categories')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lecturer_publications');
    }
};

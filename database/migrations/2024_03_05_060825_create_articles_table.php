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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('judul');
            $table->string('slug')->unique();
            $table->longText('konten');
            $table->string('gambar');
            $table->foreignId('created_by')->index();
            $table->integer('views')->default(0);
            $table->string('status');
            $table->date('publish_date');
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('category_articles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};

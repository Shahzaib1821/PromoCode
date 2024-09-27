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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('short_description');
            $table->longText('long_description');
            $table->boolean('popular_blog')->default(false);
            $table->boolean('status')->default(true);
            $table->boolean('top_blog')->default(false);
            $table->boolean('featured_blog')->default(false);
            $table->string('meta_title');
            $table->text('meta_description');
            $table->json('meta_keywords');
            $table->unsignedBigInteger('category_id');
            $table->json('faqs')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('category_id')->references('id')->on('blog_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};

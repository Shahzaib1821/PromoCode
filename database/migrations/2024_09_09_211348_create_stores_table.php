<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('website');
            $table->string('video')->nullable();
            $table->string('slug')->unique();
            $table->string('tagline')->nullable();
            $table->string('image')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->text('description');
            $table->json('faqs')->nullable();
            $table->boolean('top_stores')->default(false);
            $table->boolean('top_brands')->default(false);
            $table->boolean('popular_stores')->default(false);
            $table->boolean('status')->default(true);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->string('savings')->nullable();
            $table->string('discount')->nullable();
            $table->string('free_shipping')->nullable();
            $table->string('meta_title');
            $table->text('meta_description');
            $table->text('meta_keywords');
            $table->timestamps();

            $table->foreign('subcategory_id')->references('id')->on('sub_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stores');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('coupon_code')->unique();
            $table->foreignId('store_id')->constrained()->onDelete('cascade');
            $table->string('discounted_price');
            $table->date('expiry_date');
            $table->date('created_date');
            $table->string('affiliated_link')->nullable();
            $table->boolean('status')->default(true);
            $table->text('description');
            $table->boolean('deal_exclusive')->default(false);
            $table->boolean('verify')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('coupons');
    }
}

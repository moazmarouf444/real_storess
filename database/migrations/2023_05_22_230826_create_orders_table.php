<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_num', 50); //! create with new order dynamic
            $table->decimal('total_price', 10, 2);
            $table->enum('status',['current','finished','cancelled'])->default('current');
            $table->enum('pay_status',['done','not_done'])->default('not_done');
            $table->enum('pay_type',['cash','online'])->default('cash');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('coupon_id')->nullable()->constrained()->onDelete('cascade');
            $table->decimal('lat')->nullable();
            $table->decimal('lng')->nullable();
            $table->string('map_desc', 255)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};

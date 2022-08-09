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
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('status');
            $table->string('coupon')->nullable();
            $table->integer('totalAll');
            $table->integer('user_id');
            $table->integer('phone');
            $table->string('address');
            $table->string('name');
            $table->string('email');
            $table->text('order_note');
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
        Schema::dropIfExists('order');
    }
};

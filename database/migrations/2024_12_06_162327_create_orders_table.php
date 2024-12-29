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
            $table->unsignedBigInteger('userId');
            $table->decimal('totalPrice');
            $table->decimal('discountAmount')->default(0);
            $table->string('voucherCode');
            $table->enum('status', ['PENDING', 'COMPLETED', 'CANCELED'])->default('PENDING');
            $table->foreign('userId')->references('id')->on('users');
            $table->string('orderNotes');
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

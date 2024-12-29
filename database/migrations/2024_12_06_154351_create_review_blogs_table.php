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
        Schema::create('review_blogs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('blogId');
            $table->unsignedBigInteger('userId');
            $table->integer('rating')->default(0);
            $table->text('comment')->nullable();
            $table->tinyInteger('status');
            $table->foreign('blogId')->references('id')->on('blogs');
            $table->foreign('userId')->references('id')->on('users');
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
        Schema::dropIfExists('review_blogs');
    }
};

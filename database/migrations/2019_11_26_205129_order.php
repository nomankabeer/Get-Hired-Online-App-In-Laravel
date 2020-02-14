<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Order extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_id')->unique()->nullable();
            $table->integer('bid_id');
            $table->integer('job_id');
            $table->tinyInteger('status')->default(1);
            $table->string('client_review')->nullable();
            $table->string('worker_review')->nullable();
            $table->integer('client_rating')->nullable();
            $table->integer('worker_rating')->nullable();
            $table->dateTime('completed_date')->nullable();
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
}

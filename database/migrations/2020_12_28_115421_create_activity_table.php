<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityTable extends Migration
{
  /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->string('hour');
            $table->text('refund')->nullable();
            $table->integer('biller_id');
            $table->integer('client');
            $table->integer('user_id');
            $table->text('duration')->nullable();
            $table->text('object')->nullable();
            $table->integer('status');
            $table->text('transportation')->nullable();
            $table->text('expense')->nullable();
            $table->text('place')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('activity');
    }
}

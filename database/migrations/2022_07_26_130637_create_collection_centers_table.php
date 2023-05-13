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
        Schema::create('collection_centers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('center_no');
            $table->unsignedBigInteger('branch');
            $table->string('center_head')->nullable();
            $table->string('center_cashier')->nullable();
            $table->string('collection_day')->nullable();
            $table->string('collection_time')->nullable();
            $table->string('center_active');
            $table->string('current_address')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();

            $table->foreign('branch')->references('id')->on('company_branches');

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
        Schema::dropIfExists('collection_centers');
    }
};

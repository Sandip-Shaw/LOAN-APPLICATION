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
        Schema::create('account_code_series', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code_name')->nullable();
            $table->string('code_prefix')->nullable();
            $table->string('no_of_digit')->nullable();
            $table->string('start_digits')->nullable();
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->foreign('branch_id')->references('id')->on('company_branches');

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
        Schema::dropIfExists('account_code_series');
    }
};

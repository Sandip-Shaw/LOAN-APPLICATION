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
        Schema::create('employee_salary_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee')->nullable();
            $table->foreign('employee')->references('hrmanagement_id')->on('hr_management');
            $table->string('basic')->nullable();
            $table->string('others')->nullable();
            $table->string('HRA')->nullable();
            $table->string('fuel')->nullable();
            $table->string('DA')->nullable();
            $table->string('allowance')->nullable();
            $table->string('TA')->nullable();
            $table->string('gross_pay')->nullable();
            $table->string('PF')->nullable();
            $table->string('ESI')->nullable();
            $table->string('net_pay')->nullable();
            // $table->string('TA')->nullable();

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
        Schema::dropIfExists('employee_salary_details');
    }
};

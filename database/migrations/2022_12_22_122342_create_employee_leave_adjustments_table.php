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
        Schema::create('employee_leave_adjustments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee')->nullable();
            $table->foreign('employee')->references('hrmanagement_id')->on('hr_management');
            $table->date('doj')->nullable();
            $table->date('leave_date')->nullable();
            $table->string('purpose')->nullable();
            $table->string('leave_type')->nullable();
            $table->string('total_leave')->nullable();
            $table->enum('status', ['Pending','Approved','NotApproved'])->default('Pending');
            $table->string('remarks')->nullable();

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
        Schema::dropIfExists('employee_leave_adjustments');
    }
};

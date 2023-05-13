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
        Schema::create('investment_creates', function (Blueprint $table) {
            $table->id();
            $table->date('create_date');
            $table->unsignedBigInteger('member');
            $table->string('member_name')->nullable();

            $table->unsignedBigInteger('branch');
            $table->unsignedBigInteger('employee')->nullable();
            $table->unsignedBigInteger('scheme');
            $table->string('tenure')->nullable();
            $table->string('amount')->nullable();
            $table->string('amt_approved')->nullable();
            $table->string('interest_earned')->nullable();
            $table->string('maturity_amount')->nullable();
            $table->string('int_per_tenure')->nullable();
            $table->string('fore_close_charge')->nullable();
            $table->string('int_pay_mode')->nullable();
            $table->string('int_rate')->nullable();
            $table->enum('status', ['Approved','Disbursed','NotApproved','RequestForApproval']);
            $table->foreign('member')->references('member_id')->on('member_management');
            $table->foreign('branch')->references('id')->on('company_branches');
            $table->foreign('employee')->references('hrmanagement_id')->on('hr_management');
            $table->foreign('scheme')->references('id')->on('investment_schemes');

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
        Schema::dropIfExists('investment_creates');
    }
};

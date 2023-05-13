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
        Schema::create('hr_salary_disbursements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('disburse_salary')->nullable();
            $table->string('remarks')->nullable();
            $table->date('trans_date')->nullable();
            $table->string('paymode')->nullable();

            $table->string('bank_name_cheque')->nullable();
            $table->string('cheque_no')->nullable();
            $table->date('cheque_date')->nullable();
            $table->date('transfer_date_onlineTrans')->nullable();
            $table->string('transaction_no')->nullable();
            $table->string('transfer_mode')->nullable();

            $table->integer('employee_id')->nullable();
            $table->enum('status', ['Pending','Approved','Not Approved'])->default('Pending')->nullable();
            $table->string('comment')->nullable();

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
        Schema::dropIfExists('hr_salary_disbursements');
    }
};

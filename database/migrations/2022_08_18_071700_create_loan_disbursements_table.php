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
        Schema::create('loan_disbursements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('loan_amount')->nullable();
            $table->string('processing_fee')->nullable();
            $table->string('final_disburse_amt')->nullable();
            $table->date('loan_disburse_date')->nullable();
            $table->date('first_emi_date')->nullable();
            $table->string('disburse_amt')->nullable();
            $table->string('disburse_transaction')->nullable();
            $table->string('cheque_bank_name')->nullable();
            $table->string('cheque_no')->nullable();
            $table->date('cheque_date')->nullable();
            $table->date('onl_transfer_date')->nullable();
            $table->string('onl_transaction_no')->nullable();
            $table->string('onl_transfer_mode')->nullable();
            $table->unsignedBigInteger('loanApplication_id')->nullable();
            $table->foreign('loanApplication_id')->references('loanApplication_id')->on('loan_applications');


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
        Schema::dropIfExists('loan_disbursements');
    }
};

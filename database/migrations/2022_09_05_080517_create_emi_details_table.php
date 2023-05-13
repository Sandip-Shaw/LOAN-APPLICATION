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
        Schema::create('emi_details', function (Blueprint $table) {
            $table->bigIncrements('emi_id');

            $table->unsignedBigInteger('loan_disbursement_id')->nullable();
            $table->foreign('loan_disbursement_id')->references('id')->on('loan_disbursements');

            $table->Integer('emi_no')->nullable();
            $table->date('emi_date')->nullable();
            $table->date('emi_due_date')->nullable();
            $table->string('principal_amt')->nullable();
            $table->string('interest')->nullable();
            $table->string('other_charges')->nullable();
            $table->string('emi_amt')->nullable();
            $table->string('bal_principal')->nullable();
            $table->enum('status', ['Pending','Paid','Due','OverDue'])->default('Pending')->nullable();          
            $table->date('paid_date')->nullable();
            $table->string('paid_amt')->nullable();
            $table->string('fine_amt')->nullable();
            $table->string('total_amt')->nullable();
            $table->string('remarks')->nullable();
            $table->string('pay_mode')->nullable();
            $table->string('cheque_bank_name')->nullable();
            $table->string('cheque_no')->nullable();
            $table->string('cheque_date')->nullable();
            $table->string('onl_transfer_date')->nullable();
            $table->string('onl_transaction_no')->nullable();
            $table->string('onl_transfer_mode')->nullable();
            
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
        Schema::dropIfExists('emi_details');
    }
};

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
        Schema::create('investment_pay_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('createInvestment_id')->nullable();
            $table->foreign('createInvestment_id')->references('id')->on('investment_creates');

            $table->Integer('tenure_no')->nullable();
            $table->date('period')->nullable();
            
            $table->string('principal_amt')->nullable();
            $table->string('interest_earned')->nullable();
            $table->string('maturity_amount')->nullable();
            $table->string('int_per_tenure')->nullable();
            $table->string('bal_principal')->nullable();
            $table->enum('status', ['Pending','Paid','Due'])->default('Pending')->nullable();          
            $table->date('paid_date')->nullable();
            $table->string('paid_amt')->nullable();
        
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
        Schema::dropIfExists('investment_pay_details');
    }
};

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
        Schema::create('account_debit_credits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ledger_entries_id')->nullable();
            $table->unsignedBigInteger('ledger_account_id')->nullable();
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->string('opening_acc_balance')->nullable();
            $table->string('amount')->nullable();
            $table->string('type')->nullable();
            $table->string('closing_acc_balance')->nullable();
            $table->foreign('ledger_entries_id')->references('id')->on('ledger_entries');
            $table->foreign('ledger_account_id')->references('id')->on('ledger_accounts');

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
        Schema::dropIfExists('account_debit_credits');
    }
};

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
        Schema::create('ledger_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ledger_type')->nullable();
            $table->unsignedBigInteger('ledger_group_id')->nullable();
            $table->string('name')->nullable();
            $table->string('system_name')->nullable();
            $table->string('code')->nullable();
            $table->string('is_bank_account')->nullable();
            $table->string('show_in_day_book')->nullable();
            $table->string('total_transaction')->nullable();
            $table->timestamp('last_transaction_date')->useCurrent();
            $table->string('total_debit')->nullable();
            $table->string('total_credit')->nullable();
            $table->string('debit-credit')->nullable();
            $table->string('closing_balance')->nullable();
            $table->foreign('ledger_type')->references('ledger_types_id')->on('ledger_types');
            $table->foreign('ledger_group_id')->references('id')->on('ledger_groups');

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
        Schema::dropIfExists('ledger_accounts');
    }
};

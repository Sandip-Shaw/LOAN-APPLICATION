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
        Schema::create('members_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('member_id');
            $table->string('member_fees');
            $table->string('share_allotted_from');
            $table->string('shares');
            $table->string('share_amount');
            $table->string('payment_by');
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
        Schema::dropIfExists('members_payments');
    }
};

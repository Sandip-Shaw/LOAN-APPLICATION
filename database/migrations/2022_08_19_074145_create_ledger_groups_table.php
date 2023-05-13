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
        Schema::create('ledger_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('group_type')->nullable();
            $table->string('display_name')->nullable();
            $table->string('system_name')->nullable();
            $table->string('position')->nullable();
            $table->foreign('group_type')->references('ledger_types_id')->on('ledger_types');


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
        Schema::dropIfExists('ledger_groups');
    }
};

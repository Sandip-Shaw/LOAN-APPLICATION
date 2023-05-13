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
        Schema::create('investment_schemes', function (Blueprint $table) {
            $table->id();
            $table->string('scheme_code')->nullable();
            $table->string('scheme_name')->nullable();
            $table->string('min_amt')->nullable();
            $table->string('int_rate')->nullable();
            $table->string('term')->nullable();
            $table->string('int_pay_mode')->nullable();
            $table->string('mature_amt')->nullable();
            $table->string('active')->nullable();

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
        Schema::dropIfExists('investment_schemes');
    }
};

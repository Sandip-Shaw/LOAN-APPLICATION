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
        Schema::create('company_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('company_website');
            $table->string('company_name');
            $table->string('short_name')->nullable();
            $table->string('about_company')->nullable();
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('pincode');
            $table->string('contry');
            $table->string('mobile_no');
            $table->string('landline_no')->nullable();
           
            $table->string('email');
            $table->string('cin_no')->nullable();
            $table->string('pan_no')->nullable();
            $table->string('tan_no')->nullable();
            $table->string('gst_no')->nullable();
            $table->string('category')->nullable();
            $table->string('company_class');
            $table->date('incorporation_date');
            $table->string('incorporation_state');
            $table->string('incorporation_country');
            $table->string('authorized_capital')->nullable();
            $table->string('paid_ip_capital')->nullable();

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
        Schema::dropIfExists('company_profiles');
    }
};

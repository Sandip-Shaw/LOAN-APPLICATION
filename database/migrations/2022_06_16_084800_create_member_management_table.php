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
        Schema::create('member_management', function (Blueprint $table) {
            $table->bigIncrements('member_id');
            $table->unsignedBigInteger('associate')->nullable();
            $table->string('group')->nullable();
            $table->unsignedBigInteger('branch');
            $table->date('emr_date')->nullable();
            $table->string('title')->nullable();
            $table->string('gender')->nullable();
            $table->string('first_name')->nullable();
            
            $table->string('dob')->nullable();
            $table->string('qualification')->nullable();
            $table->string('occupation')->nullable();
            $table->string('monthly_income')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('husbandWife_name')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('address')->nullable();
            $table->string('ward')->nullable();
            $table->string('area')->nullable();
            $table->string('landmark')->nullable();
            $table->string('dist')->nullable();
            $table->string('state')->nullable();
            $table->string('pincode')->nullable();
            $table->string('country')->nullable();
            $table->string('p_address')->nullable();
            $table->string('p_dist')->nullable();
            $table->string('p_state')->nullable();
            $table->string('p_pincode')->nullable();
            $table->string('p_country')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();

            $table->string('adhar_no')->nullable();
            $table->string('voter_no')->nullable();
            $table->string('pan_no')->nullable();
            $table->string('ration_no')->nullable();
            $table->string('meter_no')->nullable();
            $table->string('cl_no')->nullable();
            $table->string('cl_relation')->nullable();
            $table->string('dl_no')->nullable();
            $table->string('passport_no')->nullable();

            $table->string('image_photo')->nullable();
            $table->string('image_idproof')->nullable();
            $table->string('image_address')->nullable();
            $table->string('image_pan')->nullable();
            $table->string('image_signature')->nullable();
            $table->string('nominee_name')->nullable();
            $table->string('nominee_relation')->nullable();
            $table->string('nominee_mobile')->nullable();
            $table->string('nominee_dob')->nullable();
            $table->string('nominee_adhar')->nullable();
            $table->string('nominee_voter')->nullable();
            $table->string('nominee_pan')->nullable();
            $table->string('nominee_ration')->nullable();
            $table->string('nominee_address')->nullable();
          
            $table->string('bank_name')->nullable();
            $table->string('bank_branch')->nullable();
            $table->string('account_no')->nullable();
            $table->string('ifsc_code')->nullable();

            $table->tinyInteger('kyc_status')->nullable();

           
            $table->enum('status', ['Active','Inactive']);
            $table->string('remarks')->nullable();


            $table->foreign('associate')->references('hrmanagement_id')->on('hr_management');
            $table->foreign('branch')->references('id')->on('company_branches');
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
        Schema::dropIfExists('member_management');
    }
};

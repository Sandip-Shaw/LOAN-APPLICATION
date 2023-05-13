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
        Schema::create('hr_management', function (Blueprint $table) {
            $table->bigIncrements('hrmanagement_id');
            $table->string('designation')->nullable();
            $table->unsignedBigInteger('branch');

            $table->string('name');
            $table->date('dob');
            $table->string('emp_code');

            $table->date('dateofjoining');
            $table->string('email')->nullable();
            $table->string('mobile');
            $table->string('address')->nullable();
            $table->string('fathername')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('fathername')->nullable();
            $table->string('account_no')->nullable();
            $table->string('ifsc_code')->nullable();
            $table->string('bank_branch_name')->nullable();
            $table->integer('member')->nullable();
            $table->string('voter_no')->nullable();
            $table->string('pan_no')->nullable();
            $table->string('adhar_no')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('monthlysalary')->nullable();
            $table->string('image')->nullable();

            $table->string('emp_image_sign')->nullable();
            $table->string('emp_pan')->nullable();
            $table->string('emp_idproof')->nullable();
            $table->integer('user_id')->nullable();
     
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
        Schema::dropIfExists('hr_management');
    }
};

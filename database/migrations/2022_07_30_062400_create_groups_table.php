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
        Schema::create('groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('group_name');
            $table->string('op_date');
            $table->string('group_branch');
            $table->string('group_leader_name');
            $table->string('mobile_no');
            $table->string('group_address');
            $table->string('assign_employee');
            $table->string('collection_day');
            $table->string('collection_time');
            $table->string('group_photo')->nullable();
            $table->string('leader_photo')->nullable();
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
        Schema::dropIfExists('groups');
    }
};

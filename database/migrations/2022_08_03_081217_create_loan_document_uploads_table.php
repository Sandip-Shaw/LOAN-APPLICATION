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
        Schema::create('loan_document_uploads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('doc_name')->nullable();
            $table->string('doc_file')->nullable();
            $table->unsignedBigInteger('loanApplication_id');

            $table->foreign('loanApplication_id')->references('loanApplication_id')->on('loan_applications');

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
        Schema::dropIfExists('loan_document_uploads');
    }
};

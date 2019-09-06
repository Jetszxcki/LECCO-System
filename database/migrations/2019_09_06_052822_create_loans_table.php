<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->unsignedInteger('member_id');
            $table->string('loan_type');
            $table->decimal('amount');
            $table->decimal('total_interest');
            $table->decimal('total_loan_receivable');
            $table->unsignedInteger('term');
            $table->float('interest_per_annum');
            $table->date('start_of_payment');
            //$table->string('status');
            $table->string('remarks');
            $table->timestamps();
            //$table->foreign('member_id')->references('id')->on('members');
            // $table->foreign('loan_type')->references('name')->on('loan_types')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loans');
    }
}

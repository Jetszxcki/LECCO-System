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
        Schema::create('loans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('member_id');
            $table->bigInteger('loan_type');
            $table->decimal('amount');
			$table->unsignedInteger('term');
			$table->date('start_of_payment');
            $table->float('interest_per_annum');
            //$table->string('status');
            $table->string('remarks')->nullable();
            $table->timestamps();
            // $table->foreign('member_id')->references('id')->on('members');
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

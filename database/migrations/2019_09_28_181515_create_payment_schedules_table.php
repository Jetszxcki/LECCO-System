<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_schedules', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->bigInteger('loan_payroll_id');
            $table->bigInteger('term');
            $table->date('expected_payment_date');
            $table->date('actual_payment_date')->nullable();
            $table->decimal('penalty_interest',12,2)->default('0.00');
            $table->decimal('total_payment',12,2);
            $table->decimal('interest',12,2);
            $table->decimal('principal_payment',12,2);
            $table->decimal('remaining_principal',12,2);
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
        Schema::dropIfExists('payment_schedules');
    }
}

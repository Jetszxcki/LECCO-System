<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_vouchers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('transaction_id');
            // just copied the columns below from our past schema
            // not sure yet if these are placed here
            $table->bigInteger('cv_no');
            $table->date('date_disbursed')->nullable();
            $table->string('disbursed_by');
            $table->string('check_no');
            $table->string('attachment')->nullable();
            $table->timestamps();
            $table->unique('cv_no');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('check_vouchers');
    }
}

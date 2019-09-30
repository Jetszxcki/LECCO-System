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
            $table->bigInteger('cv_no');
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

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessRightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access_rights', function (Blueprint $table){
            $table->bigInteger('user_id');
            $table->boolean('user_view_list')->default(false);
            $table->boolean('user_delete')->default(false);
            $table->boolean('invoke_rights')->default(false);

            $table->boolean('member_view_list')->default(true);
            $table->boolean('member_view')->default(true);
            $table->boolean('member_create')->default(false);
            $table->boolean('member_edit')->default(false);
            $table->boolean('member_delete')->default(false);

            $table->boolean('loan_types_view_list')->default(true);
            $table->boolean('loan_types_view')->default(true);
            $table->boolean('loan_types_create')->default(false);
            $table->boolean('loan_types_edit')->default(false);
            $table->boolean('loan_types_delete')->default(false);
			
			$table->boolean('loans_view_list')->default(true);
            $table->boolean('loans_view')->default(true);
            $table->boolean('loans_create')->default(false);
            $table->boolean('loans_edit')->default(false);
            $table->boolean('loans_delete')->default(false);

            $table->boolean('chart_of_accounts_view_list')->default(true);
            $table->boolean('chart_of_accounts_view')->default(true);
            $table->boolean('chart_of_accounts_create')->default(false);
            $table->boolean('chart_of_accounts_edit')->default(false);
            $table->boolean('chart_of_accounts_delete')->default(false);

            $table->boolean('check_vouchers_view_list')->default(true);
            $table->boolean('check_vouchers_view')->default(true);
            $table->boolean('check_vouchers_create')->default(false);
            $table->boolean('check_vouchers_edit')->default(false);
            $table->boolean('check_vouchers_delete')->default(false);

            $table->boolean('transactions_view_list')->default(true);
            $table->boolean('transactions_view')->default(true);
            $table->boolean('transactions_create')->default(false);
            $table->boolean('transactions_edit')->default(false);
            $table->boolean('transactions_delete')->default(false);
			
            $table->boolean('shares_view_list')->default(true);
            $table->boolean('shares_view')->default(true);
            $table->boolean('shares_create')->default(false);
            $table->boolean('shares_edit')->default(false);
            $table->boolean('shares_delete')->default(false);

            $table->boolean('signatories_view_list')->default(true);
            $table->boolean('signatories_create')->default(false);
            $table->boolean('signatories_edit')->default(false);
            $table->boolean('signatories_delete')->default(false);

            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('access_rights');
    }
}

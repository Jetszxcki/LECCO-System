<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->date('birthday');
            $table->unsignedInteger('age');
            $table->string('gender');
            $table->string('civil_status');
            $table->string('religion');
            $table->string('highest_educational_attainment');
            $table->unsignedInteger('no_of_dependents');
            $table->string('residential_address');
            $table->string('TIN');
            $table->string('employer');
            $table->string('department');
            $table->string('position');
            $table->decimal('annual_income');
            $table->unsignedInteger('length_of_service(years)');
            $table->string('status_of_employment');
            $table->unsignedInteger('no_of_subscribed_shares');
            $table->unsignedInteger('years_to_fully_pay');
            $table->string('profile_picture')->nullable();
            $table->string('contact_no');
            // $table->string('status');
            // $table->string('remarks');
            $table->date('date_accepted');
            $table->string('BOD_resolution_number');
            $table->string('type_of_membership');
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
        Schema::dropIfExists('members');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('personel_number');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('ssn');
            $table->string('job_location');
            $table->string('manager');
            $table->string('hr_rep');
            $table->string('field_admin');
            $table->string('drug_pool');
            $table->integer('excluded')->default(0);
            $table->integer('role')->default(1);
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

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransportMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transport_members', function (Blueprint $table) {
            $table->increments('transport_member_id');
            $table->integer('school_id');
            $table->integer('student_id');
            $table->integer('class_id');
            $table->integer('section_id');
            $table->integer('transport_id');
            $table->double('transport_fees');
            $table->timestamps();
            $table->SoftDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transport_members');
    }
}

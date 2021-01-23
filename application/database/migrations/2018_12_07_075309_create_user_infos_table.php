<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_infos', function (Blueprint $table) {
            $table->increments('user_id');
            $table->integer('school_id');
            $table->string('use_name');
            $table->string('user_designation');
            $table->string('user_gender');
            $table->string('user_blood_group');
            $table->date('user_birthday');
            $table->string('user_religion');
            $table->date('user_join_date');
            $table->string('user_phone');
            $table->string('user_address');
            $table->string('user_state')->nullable();
            $table->string('user_country')->nullable();
            $table->string('user_image');
            $table->string('user_role');
            $table->string('user_email');
            $table->string('password');
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
        Schema::dropIfExists('user_infos');
    }
}

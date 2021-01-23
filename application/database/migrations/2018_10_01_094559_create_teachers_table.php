<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->increments('teacher_id');        
            $table->integer('school_id'); 
            $table->integer('user_id');
            $table->string('teacher_name',255);       
            $table->string('teacher_designation',255);  
            $table->string('teacher_gender',255);   
            $table->string('teacher_blood_group',255)->nullable();  
            $table->date('teacher_birthday');
            $table->string('teacher_religion',255);
            $table->date('teacher_joining_date');
            $table->string('teacher_phone',255);
            $table->string('teacher_address',255);
            $table->string('teacher_state',255)->nullable();
            $table->string('teacher_country',255);
            $table->string('teacher_photo',255);
            $table->string('teacher_email',255);
            $table->string('teacher_card_id',255)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teachers');
    }
}

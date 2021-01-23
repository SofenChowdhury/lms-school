<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOldStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('old_students', function (Blueprint $table) {
            $table->increments('old_student_id');          
            $table->integer('student_id');          
            $table->integer('user_id');   
            $table->integer('school_id'); 
            $table->integer('student_guardian_id');            
            $table->string('student_country',255);
            $table->integer('student_class_id');
            $table->integer('student_section_id');
            $table->string('student_name',255);       
            $table->date('student_birthday');       
            $table->string('student_gender',255);
            $table->string('student_blood_group',255)->nullable();
            $table->string('student_religion',255);
            $table->string('student_email',255);
            $table->string('student_phone',255);
            $table->string('student_address',255,255);
            $table->string('student_state',255);
            $table->string('student_group',255);
            $table->string('student_optional_subject',255)->nullable();
            $table->string('student_register_no',255);
            $table->string('student_roll_no',255);
            $table->string('student_photo',255);
            $table->string('student_card_id')->nullable();
            $table->string('student_extra_curricular_activities',255)->nullable();
            $table->string('student_remarks',255)->nullable();
            $table->Date('student_academic_year');
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
        Schema::dropIfExists('old_students');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmissionFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admission_forms', function (Blueprint $table) {
            $table->increments('admission_id');
            $table->integer('school_id');
            $table->string('student_photo',255);
            $table->string('student_name',255);
            $table->integer('student_class_id');
            $table->date('student_birthday');
            $table->string('student_gender');
            $table->string('student_blood_group');
            $table->string('student_religion',255);
            $table->string('student_email',255);
            $table->string('student_phone',255);
            $table->string('student_address',255);
            $table->string('student_group',255);
            $table->string('student_gurdian',255);
            $table->string('student_gurdian_photo',255);
            $table->string('student_gurdian_profession',255);
            $table->string('student_gurdian_address',255);
            $table->string('student_country',255);
            $table->string('student_gurdian_country',255);
            $table->string('student_gurdian_email',255)->nullable();
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
        Schema::dropIfExists('admission_forms');
    }
}

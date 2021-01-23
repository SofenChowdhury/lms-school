<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamAttendencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_attendences', function (Blueprint $table) {
            $table->increments('exam_attn_id');
            $table->integer('school_id');
            $table->integer('student_id');
            $table->integer('class_id');
            $table->integer('exam_id');
            $table->integer('subject_id');
            $table->string('attendence');
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
        Schema::dropIfExists('exam_attendences');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_marks', function (Blueprint $table) {
            $table->increments('marks_id');
            $table->integer('school_id');
            $table->integer('student_id');
            $table->integer('exam_id');
            $table->integer('class_id');
            $table->integer('subject_id');
            $table->double('mcq_marks')->define('0');
            $table->double('theory_marks')->define('0');
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
        Schema::dropIfExists('exam_marks');
    }
}

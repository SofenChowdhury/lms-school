<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->increments('subject_id');     
            $table->integer('school_id');       
            $table->integer('subject_teacher_id');       
            $table->integer('subject_class_id');
            $table->string('subject_type',255);
            $table->string('subject_subject_name',255);
            $table->string('subject_pass_mark',255);
            $table->string('subject_final_mark',255);
            $table->string('subject_author_name',255)->nullable();
            $table->string('subject_code',255)->nullable();
            $table->text('subject_note')->nullable();
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
        Schema::dropIfExists('subjects');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassRoutinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_routines', function (Blueprint $table) {
            $table->increments('routine_id');        
            $table->integer('school_id');     
            $table->integer('class_id');       
            $table->integer('subject_id');
            $table->integer('subject_teacher_id');
            $table->string('start_time',255);
            $table->string('end_time',255);
            $table->string('day',255);
            $table->text('class_note')->nullable();
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
        Schema::dropIfExists('class_routines');
    }
}

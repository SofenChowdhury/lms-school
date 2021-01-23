<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('quiz_title');
            $table->integer('quiz_type');
            $table->double('quiz_marks');
            $table->integer('class_id')->unsigned();
            $table->integer('section_id')->unsigned();
            $table->text('quiz_note')->nullable();
            $table->datetime('quiz_date');
            $table->time('quiz_start_time');
            $table->time('quiz_end_time');
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
        Schema::dropIfExists('quiz_infos');
    }
}

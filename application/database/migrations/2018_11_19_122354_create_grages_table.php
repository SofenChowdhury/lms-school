<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grages', function (Blueprint $table) {
            $table->increments('grade_id');
            $table->integer('school_id');
            $table->string('grade_name');
            $table->double('grade_point');
            $table->double('mark');
            $table->double('min_mark');
            $table->string('grade_note')->nullable();
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
        Schema::dropIfExists('grages');
    }
}

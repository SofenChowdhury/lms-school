<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->increments('section_id');      
            $table->integer('school_id');   
            $table->integer('class_id');       
            $table->integer('section_teacher_id');       
            $table->string('section_name',255);
            $table->string('section_capacity',255)->nullable();
            $table->string('section_category',255)->nullable();
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
        Schema::dropIfExists('sections');
    }
}

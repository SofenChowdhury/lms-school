<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->increments('assignment_id');      
            $table->integer('school_id');   
            $table->integer('assignment_class_id');
            $table->integer('assignment_section_id');
            $table->integer('assignment_subject_id');
            $table->string('assignment_title',255);       
            $table->text('assignment_description')->nullable();
            $table->string('assignment_file',255);
            $table->string('assignment_deadline',255);
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
        Schema::dropIfExists('assignments');
    }
}

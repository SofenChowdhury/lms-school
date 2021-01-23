<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMissionVisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mission_visions', function (Blueprint $table) {
            $table->increments('id');        
            $table->integer('school_id'); 
            $table->string('title',255);  
            $table->longtext('description');   
            $table->string('title2',255); 
            $table->longtext('description2');   
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
        Schema::dropIfExists('mission_visions');
    }
}

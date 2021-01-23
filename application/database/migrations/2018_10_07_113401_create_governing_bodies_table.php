<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoverningBodiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('governing_bodies', function (Blueprint $table) {
            $table->increments('id');    
            $table->integer('school_id');     
            $table->string('name',255);  
            $table->string('image',255);  
            $table->string('designation',255); 
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
        Schema::dropIfExists('governing_bodies');
    }
}

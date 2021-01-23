<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');        
            $table->integer('school_id'); 
            $table->string('title',255);       
            $table->string('image',255)->nullable();  
            $table->date('date');    
            $table->string('event_time',255);    
            $table->string('location',255)nullable();  
            $table->text('short_description');
            $table->longtext('description')nullable();
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
        Schema::dropIfExists('events');
    }
}

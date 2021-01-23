<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('its', function (Blueprint $table) {
            $table->increments('id');        
            $table->integer('school_id'); 
            $table->string('title',255);       
            $table->string('image',255)->nullable();
            $table->text('short_description');
            $table->longtext('description');
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
        Schema::dropIfExists('its');
    }
}

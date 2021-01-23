<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChairmanMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chairman_messages', function (Blueprint $table) {
            $table->increments('id');        
            $table->integer('school_id'); 
            $table->string('title',255);  
            $table->text('short_description');  
            $table->longtext('description')->nullable();                 
            $table->string('image',255);
            $table->string('name',255);
            $table->string('designation',255);
            $table->string('institute_name',255);
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
        Schema::dropIfExists('chairman_messages');
    }
}

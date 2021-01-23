<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parents', function (Blueprint $table) {
            $table->increments('id');        
            $table->integer('school_id'); 
            $table->integer('user_id');
            $table->string('guardian_name',255);       
            $table->string('guardian_fathers_name',255);
            $table->string('guardian_mothers_name',255);
            $table->string('guardian_fathers_profession',255)->nullable();
            $table->string('guardian_mothers_profession',255)->nullable();
            $table->string('guardian_address',255);
            $table->string('guardian_country',255);
            $table->string('guardian_email',255);
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
        Schema::dropIfExists('parents');
    }
}

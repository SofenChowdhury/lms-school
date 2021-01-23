<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_infos', function (Blueprint $table) {
            $table->increments('school_id');     
            $table->string('name',255)->nullable();      
            $table->string('logo',255)->nullable(); 
            $table->string('email',255)->nullable(); 
            $table->string('phone',255)->nullable(); 
            $table->string('address',255)->nullable(); 
            $table->string('enrollment',255)->nullable(); 
            $table->string('eiin_no',255)->nullable();
            $table->string('domain_name',255)->nullable();
            $table->text('short_description')->nullable();
            $table->longtext('description')->nullable(); 
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
        Schema::dropIfExists('school_infos');
    }
}

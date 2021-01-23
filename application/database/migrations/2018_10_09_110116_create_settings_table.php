<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');        
            $table->integer('school_id'); 
            $table->string('name',255);       
            $table->string('image',255);
            $table->string('logo_banner',255);
            $table->string('banner',255);
            $table->string('address',255);
            $table->string('phone',255);
            $table->string('email')->unique();
            $table->string('fb_link',255)->nullable();
            $table->string('twitter_link',255)->nullable();
            $table->string('google_plus_link',255)->nullable();
            $table->string('linkedin_link',255)->nullable();
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
        Schema::dropIfExists('settings');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_payments', function (Blueprint $table) {
            $table->increments('pay_id');
            $table->string('school_name');
            $table->string('school_domain_name');
            $table->string('user_name');
            $table->integer('mm_id');
            $table->string('title',255);
            $table->text('description')->nullable();
            $table->double('amount');
            $table->string('transection_id',255);
            $table->integer('status');
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
        Schema::dropIfExists('company_payments');
    }
}

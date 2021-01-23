<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('invoice_id');
            $table->integer('school_id');
            $table->integer('class_id');
            $table->integer('student_id');
            $table->integer('fee_type_id');
            $table->double('paid');
            $table->double('total_fee');
            $table->double('discount');
            $table->date('invoice_date');
            $table->string('note')->nullable();
            $table->timestamps();
            $table->SoftDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Customers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('mobile_no');
            $table->string('contact_no');
            $table->string('email');
            $table->string('address');
            $table->string('faxno');
            $table->string('city');
            $table->string('state');
            $table->string('contact_person');
            $table->string('tax_reg_no');
            $table->unsignedBigInteger('customers_type_id');
            $table->foreign('customers_type_id')->references('id')->on('customers_type');
            $table->string('description');
            $table->tinyInteger('is_del')->default(0);
            $table->Integer('created_by');
            $table->dateTime('created_at');
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}

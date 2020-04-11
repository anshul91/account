<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('master_product_id');
            $table->foreign('master_product_id')->references('id')->on('master_products');            
            $table->unsignedBigInteger('unit_id');
            $table->foreign('unit_id')->references('id')->on('units');          
            $table->string('title');
            $table->string('sub_title');
            $table->string('description');
            $table->tinyInteger('is_del')->default(0);
            $table->Integer('created_by');
            $table->dateTime('created_at');
            $table->timestamp('updated_at')->useCurrent();

            // $table->foreign('master_product_id')->references('id')->on('master_products');
            // $table->foreign('unit_id')->references('id')->on('units');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}

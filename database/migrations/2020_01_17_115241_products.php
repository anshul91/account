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
            $table->integer('master_product_id');            
            $table->integer('unit_id');            
            $table->tinyInteger('is_dimension')->comment("1=>having dimensions,2=>no dimension specified");
            $table->string('title');
            $table->string('sub_title');
            $table->string('description');
            $table->integer('stock_in_hand');
            $table->string('final_product');
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

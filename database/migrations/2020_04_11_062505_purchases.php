<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Purchases extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('purchase_code')->length(11);
            $table->unsignedBigInteger('seller_id');
            $table->string('bill_no')->nullable();
            $table->foreign('seller_id')->references('id')->on('sellers');
            $table->dateTime('purchase_date');
            $table->tinyInteger('purchase_status')->default(1)->comments('0=>pending,1=>completed,2=>return');
            $table->string('description');
            $table->tinyInteger('is_del')->default(0)->comment(
                '0=>not deleted 1=>deleted'
            );
            $table->Integer('created_by');
            $table->dateTime('created_at');
            $table->timestamp('updated_at')->useCurrent();
        });
        DB::statement('ALTER TABLE purchase CHANGE purchase_code reference INT(8) UNSIGNED ZEROFILL NOT NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase');

    }
}

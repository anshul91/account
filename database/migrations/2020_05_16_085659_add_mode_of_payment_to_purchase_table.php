<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddModeOfPaymentToPurchaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchase', function (Blueprint $table) {
            $table->enum('payment_mode', ['cash','cheque','others'])->after('purchase_status');
            $table->date('payment_reminder')->after('payment_mode')->nullable();
            $table->enum('is_paid', [0,1])->default(0)->after('payment_reminder');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchase', function (Blueprint $table) {
            $table->dropColumn(['payment_mode', 'payment_reminder', 'is_paid']);
        });
    }
}

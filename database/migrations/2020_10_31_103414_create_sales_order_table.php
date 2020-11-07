<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_order', function (Blueprint $table) {
            $table->string('numSO', 20);
            $table->bigInteger('responsibleEmployee')->unsigned();
            $table->bigInteger('customer')->unsigned();
            $table->date('date');
            $table->date('validTo');
            $table->tinyInteger('transactionStatus');
            $table->integer('totalItem');
            $table->integer('totalMeubleDiscount');
            $table->integer('totalPrice');
            $table->string('paymentDiscount', 20);
            $table->integer('totalDiscount');
            $table->integer('totalPayment');
        });

        Schema::table('sales_order', function (Blueprint $table) {
            $table->primary('numSO');
            $table->foreign('responsibleEmployee')
                ->references('id')
                ->on('employee')
                ->cascadeOnDelete();
            $table->foreign('customer')
                ->references('id')
                ->on('customer')
                ->cascadeOnDelete();
            $table->foreign('paymentDiscount')
                ->references('code')
                ->on('discount')
                ->cascadeOnDelete();
            $table->foreign('transactionStatus')
                ->references('id')
                ->on('transaction_status')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_order');
    }
}

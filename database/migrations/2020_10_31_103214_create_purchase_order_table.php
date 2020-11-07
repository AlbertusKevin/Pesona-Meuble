<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_order', function (Blueprint $table) {
            $table->string('numPO', 20);
            $table->string('vendor', 255);
            $table->bigInteger('responsibleEmployee')->unsigned();
            $table->date('date');
            $table->date('validTo');
            $table->tinyInteger('transactionStatus');
            $table->integer('totalItem');
            $table->integer('freightIn');
            $table->integer('totalPrice');
            $table->integer('totalDiscount');
            $table->integer('totalPayment');
        });

        Schema::table('purchase_order', function (Blueprint $table) {
            $table->primary('numPO', 255);
            $table->foreign('vendor')
                ->references('companyCode')
                ->on('vendor')
                ->cascadeOnDelete();
            $table->foreign('responsibleEmployee')
                ->references('id')
                ->on('employee')
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
        Schema::dropIfExists('purchase_order');
    }
}

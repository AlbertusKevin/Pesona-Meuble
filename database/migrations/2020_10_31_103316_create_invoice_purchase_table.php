<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicePurchaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_purchase', function (Blueprint $table) {
            $table->string('numPO', 20);
            $table->bigInteger('responsibleEmployee')->unsigned();
            $table->boolean('receivedStatus');
            $table->date('date');
        });

        Schema::table('invoice_purchase', function (Blueprint $table) {
            $table->primary('numPO');
            $table->foreign('numPO')
                ->references('numPO')
                ->on('purchase_order')
                ->cascadeOnDelete();
            $table->foreign('responsibleEmployee')
                ->references('id')
                ->on('employee')
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
        Schema::dropIfExists('invoice_purchase');
    }
}

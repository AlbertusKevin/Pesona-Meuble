<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('delivery', function (Blueprint $table) {
            $table->bigInteger('deliveryNum');
            $table->string('numInvoiceSO', 20);
            $table->string('shippingPoint', 255);
            $table->boolean('status');
            $table->date('dateDelivery');
            $table->date('dateReceived');
        });

        Schema::table('delivery', function (Blueprint $table) {
            $table->primary(['deliveryNum', 'numInvoiceSO']);
            $table->foreign('numInvoiceSO')
                ->references('numInvoiceSO')
                ->on('invoice_sales')
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
        Schema::dropIfExists('delivery');
    }
}

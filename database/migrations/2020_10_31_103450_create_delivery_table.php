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
        Schema::create('delivery', function (Blueprint $table) {
            $table->bigIncrements('deliveryNum');
            $table->string('numSO', 20);
            $table->string('shippingPoint', 255);
            $table->date('dateDelivery');
            $table->date('dateReceived');
            $table->boolean('status');
            $table->string('notes', 255);
        });

        Schema::table('delivery', function (Blueprint $table) {
            $table->foreign('numSO')
                ->references('numSO')
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

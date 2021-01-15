<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrderLineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_order_line', function (Blueprint $table) {
            $table->string('numPO', 20);
            $table->string('modelType', 255);
            $table->integer('buying_price');
            $table->integer('quantity');
        });

        Schema::table('purchase_order_line', function (Blueprint $table) {
            $table->primary(['numPO', 'modelType']);
            $table->foreign('modelType')
                ->references('modelType')
                ->on('meuble')
                ->cascadeOnDelete();
            $table->foreign('numPO')
                ->references('numPO')
                ->on('purchase_order')
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
        Schema::dropIfExists('purchase_order_line');
    }
}

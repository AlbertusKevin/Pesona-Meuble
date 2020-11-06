<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesOrderLineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_order_line', function (Blueprint $table) {
            $table->string('numSO', 20);
            $table->string('modelType', 255);
            $table->integer('price');
            $table->string('discountMeuble', 20);
            $table->integer('quantity');
        });

        Schema::table('sales_order_line', function (Blueprint $table) {
            $table->primary(['numSO', 'modelType']);
            $table->foreign('numSO')
                ->references('numSO')
                ->on('sales_order')
                ->cascadeOnDelete();
            $table->foreign('modelType')
                ->references('modelType')
                ->on('meuble')
                ->cascadeOnDelete();
            $table->foreign('discountMeuble')
                ->references('code')
                ->on('discount')
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
        Schema::dropIfExists('sales_order_line');
    }
}

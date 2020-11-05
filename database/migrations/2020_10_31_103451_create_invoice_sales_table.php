<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoce_sales', function (Blueprint $table) {
            $table->string('numInvoiceSO', 20);
            $table->string('numSO', 20);
            $table->bigInteger('deliveryNum');
            $table->bigInteger('responsibleEmployee');
            $table->date('date');
        });

        Schema::table('invoce_sales', function (Blueprint $table) {
            $table->primary('numInvoiceSO', 20);
            $table->foreign('numSO')
                ->references('numSO')
                ->on('sales_order')
                ->cascadeOnDelete();
            $table->foreign('responsibleEmployee')
                ->references('id')
                ->on('employee')
                ->cascadeOnDelete();
            $table->foreign('deliveryNum')
                ->references('deliveryNum')
                ->on('delivery')
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
        Schema::dropIfExists('invoice_sales');
    }
}

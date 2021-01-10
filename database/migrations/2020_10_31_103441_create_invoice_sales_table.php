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
        Schema::create('invoice_sales', function (Blueprint $table) {
            $table->string('numSO', 20);
            $table->bigInteger('responsibleEmployee')->unsigned();
            $table->date('date');
            $table->tinyInteger('isSent');
            $table->tinyInteger('isComplete');
        });

        Schema::table('invoice_sales', function (Blueprint $table) {
            $table->primary('numSO');
            $table->foreign('numSO')
                ->references('numSO')
                ->on('sales_order')
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
        Schema::dropIfExists('invoice_sales');
    }
}

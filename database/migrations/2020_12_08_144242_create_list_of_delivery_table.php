<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListOfDeliveryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_deliveries', function (Blueprint $table) {
            $table->string('numSO', 20);
            $table->bigInteger('deliveryNum')->unsigned();
        });

        Schema::table('list_deliveries', function (Blueprint $table) {
            $table->primary(['deliveryNum', 'numSO']);
            $table->foreign('numSO')
                ->references('numSO')
                ->on('invoice_sales')
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
        Schema::dropIfExists('list_deliveries');
    }
}

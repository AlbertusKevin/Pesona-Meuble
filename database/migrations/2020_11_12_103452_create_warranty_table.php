<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarrantyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warranty', function (Blueprint $table) {
            $table->string('numSO', 20);
            $table->string('modelType', 255);
            $table->bigInteger('responsibleEmployee')->unsigned();
            $table->date('fromDate');
            $table->date('toDate');
            $table->integer('quantity');
            $table->string('description', 255);
            $table->tinyInteger('status');
        });

        Schema::table('warranty', function (Blueprint $table) {
            $table->primary(['numSO', 'modelType']);
            $table->foreign('numSO')
                ->references('numSO')
                ->on('invoice_sales')
                ->cascadeOnDelete();
            $table->foreign('responsibleEmployee')
                ->references('id')
                ->on('employee')
                ->cascadeOnDelete();
            $table->foreign('modelType')
                ->references('modelType')
                ->on('meuble')
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
        Schema::dropIfExists('warranty');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount', function (Blueprint $table) {
            $table->string('code', 20);
            $table->string('description', 255);
            $table->float('percentDisc', 5, 2);
            $table->bigInteger('responsibleEmployee')->unsigned();
            $table->boolean('statusActive');
            $table->date('from');
            $table->date('to');
            $table->tinyInteger('discountFor');
        });

        Schema::table('discount', function (Blueprint $table) {
            $table->primary('code');
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
        Schema::dropIfExists('discount');
    }
}

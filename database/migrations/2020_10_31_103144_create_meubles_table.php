<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeublesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meuble', function (Blueprint $table) {
            $table->string('modelType', 255);
            $table->string('image', 255);
            $table->string('name', 255);
            $table->string('description', 255);
            $table->integer('price');
            $table->bigInteger('category')->unsigned();
            $table->tinyInteger('warantyPeriodeMonth');
            $table->string('size', 25);
            $table->integer('stock');
            $table->string('vendor', 255);
            $table->string('color', 25);
            $table->tinyInteger('status');
        });

        Schema::table('meuble', function (Blueprint $table) {
            $table->primary('modelType');
            $table->foreign('category')
                ->references('id')
                ->on('meuble_category')
                ->onDelete('cascade');
            $table->foreign('vendor')
                ->references('companyCode')
                ->on('vendor')
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
        Schema::dropIfExists('meuble');
    }
}

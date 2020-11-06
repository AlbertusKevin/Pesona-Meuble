<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor', function (Blueprint $table) {
            $table->string('companyCode', 255);
            $table->string('name', 255);
            $table->string('email', 255);
            $table->string('telephone', 255);
            $table->string('address', 255);
        });

        Schema::table('vendor', function (Blueprint $table) {
            $table->primary('companyCode');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendor');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receive_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('receive_id');
            $table->foreignId('product_id');
            $table->integer('system_stock');
            $table->integer('receive_stock');
            $table->integer('final_stock');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('receive_details');
    }
};

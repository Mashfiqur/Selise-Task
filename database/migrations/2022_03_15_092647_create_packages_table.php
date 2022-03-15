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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id')->unsigned()->nullable()->index();
            $table->bigInteger('product_id')->unsigned()->nullable()->index();
            $table
                ->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->onDelete('cascade');
            $table
                ->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');
            $table->integer('quantity')->default(1);
            $table->float('price')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('packages');
    }
};

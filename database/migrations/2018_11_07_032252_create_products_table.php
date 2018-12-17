<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('menu_id');
            $table->string('code');
            $table->string('origin');
            $table->string('price')->nullable();
            $table->string('promotion_price')->nullable();
            $table->tinyInteger('promotion')->default(0);
            $table->string('mass')->nullable();
            $table->string('mass_unit')->nullable();
            $table->string('quantity')->nullable();
            $table->string('quantity_unit')->nullable();
            $table->integer('view')->default(0);
            $table->dateTime('publish_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->string('author');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}

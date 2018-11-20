<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuProductTranslateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_product_translate', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('menu_product_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name', 200);
            $table->string('slug', 200);
            $table->text('description');
            $table->unique(['menu_product_id','locale']);
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
        Schema::dropIfExists('menu_product_translate');
    }
}

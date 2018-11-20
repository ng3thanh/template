<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuNewTranslateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_new_translate', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('menu_new_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name', 200);
            $table->string('slug', 200);
            $table->text('description');
            $table->unique(['menu_new_id','locale']);
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
        Schema::dropIfExists('menu_new_translate');
    }
}

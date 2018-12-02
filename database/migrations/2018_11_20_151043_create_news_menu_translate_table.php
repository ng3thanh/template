<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsMenuTranslateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_menu_translate', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('news_menu_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name', 200);
            $table->string('slug', 200);
            $table->text('description');
            $table->unique(['news_menu_id','locale']);
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
        Schema::dropIfExists('news_menu_translate');
    }
}

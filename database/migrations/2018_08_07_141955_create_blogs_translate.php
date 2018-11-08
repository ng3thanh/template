<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTranslate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs_translate', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('blogs_id')->unsigned();
            $table->string('locale')->index();
            $table->string('title', 200);
            $table->string('slug', 200);
            $table->text('description');
            $table->text('content');
            $table->string('tags')->nullable();
            $table->unique(['blogs_id','locale']);
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
        Schema::dropIfExists('blogs_translate');
    }
}

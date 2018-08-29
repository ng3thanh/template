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
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('slug');
            $table->dropColumn('description');
            $table->dropColumn('content');
        });

        Schema::create('blogs_translate', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('blogs_id')->unsigned();
            $table->string('locale')->index();

            $table->string('title', 200);
            $table->string('slug', 200);
            $table->text('description');
            $table->text('content');

            $table->unique(['blogs_id','locale']);
            $table->foreign('blogs_id')->references('id')->on('blogs')->onDelete('cascade');
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

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceTranslate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('slug');
            $table->dropColumn('description');
            $table->dropColumn('content');
        });

        Schema::create('services_translate', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('services_id')->unsigned();
            $table->string('locale')->index();

            $table->string('name', 200);
            $table->string('slug', 200);
            $table->text('description')->nullable();
            $table->text('content');

            $table->unique(['services_id','locale']);
            $table->foreign('services_id')->references('id')->on('services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services_translate');
    }
}

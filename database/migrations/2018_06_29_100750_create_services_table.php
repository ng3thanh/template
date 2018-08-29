<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 200);
            $table->string('slug', 200);
            $table->string('price')->nullable();
            $table->double('star', 4, 2);
            $table->integer('vote');
            $table->text('description')->nullable();
            $table->text('information')->nullable();
            $table->text('content');
            $table->tinyInteger('status');
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
        Schema::dropIfExists('services');
    }
}

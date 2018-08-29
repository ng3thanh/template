<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeDbLogo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('logo', function (Blueprint $table) {
            $table->string('content1')->after('image')->nullable();
            $table->string('content2')->after('content1')->nullable();
            $table->string('content3')->after('content2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('logo', function (Blueprint $table) {
            $table->dropColumn('content1');
            $table->dropColumn('content2');
            $table->dropColumn('content3');
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('pid');
            $table->integer('uid')->unsigned();//foriegn key to users table
            $table->string('name');
            $table->float('lat', 10, 6); //as recommended in google dev docs https://developers.google.com/maps/documentation/javascript/mysql-to-maps#createtable
            $table->float('long', 10, 6);
            $table->decimal('value', 11, 2);//currency, up to 9,999,999,999.99
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('property');
    }
}

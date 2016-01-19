<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->increments('id');
	        $table->integer('project_id')->unsigned();
	        $table->foreign('project_id')->references('id')->on('projects');
	        $table->string('name');
	        $table->string('ip');
	        $table->string('server_user');
	        $table->string('connection_status');
	        $table->string('path');
	        $table->boolean('receives_code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('servers');
    }
}

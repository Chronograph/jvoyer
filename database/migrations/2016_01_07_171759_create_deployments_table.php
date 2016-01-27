<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeploymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deployments', function (Blueprint $table) {
            $table->increments('id');
	        $table->integer('project_id')->unsigned();
	        $table->foreign('project_id')->references('id')->on('projects');
	        $table->integer('server_id')->unsigned();
	        $table->foreign('server_id')->references('id')->on('servers');
	        $table->string('committer');
	        $table->string('commit');
	        $table->string('status');
	        $table->text('clone_log');
	        $table->text('composer_log');
	        $table->text('activate_log');
	        $table->text('purge_log');
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
        Schema::drop('deployments');
    }
}

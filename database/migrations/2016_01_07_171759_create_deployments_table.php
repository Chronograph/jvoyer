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
	        $table->timestamp('clone_start');
	        $table->timestamp('clone_done');
	        $table->text('composer_log');
	        $table->timestamp('composer_start');
	        $table->timestamp('composer_done');
	        $table->text('activate_log');
	        $table->timestamp('activate_start');
	        $table->timestamp('activate_done');
	        $table->text('purge_log');
	        $table->timestamp('purge_start');
	        $table->timestamp('purge_done');
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

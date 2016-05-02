<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLogImageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('image_log', function($table) {
			$table->increments('id');
			$table->integer('image_id')->unsigned();
			$table->integer('log_id')->unsigned();			
			$table->integer('count')->default(0);
			$table->timestamps();
			
			$table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
			$table->foreign('log_id')->references('id')->on('logs')->onDelete('cascade');						
		});	
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('image_log');
	}

}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeVideoImageMapping extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('videos', function($table) {
			$table->dropColumn('image');
			$table->integer('image_id')->unsigned();
			$table->foreign('image_id')->references('id')->on('images');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('videos', function($table) {
			$table->string('image');
			$table->dropColumn('image_id');
		});
	}

}

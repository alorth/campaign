<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditLogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('logs', function($table) {
			$table->string('ip');
			$table->string('uuid');
			$table->float('youtube_time');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('logs', function($table) {
			$table->dropColumn('ip');
			$table->dropColumn('uuid');
			$table->dropColumn('youtube_time');
		});
	}

}

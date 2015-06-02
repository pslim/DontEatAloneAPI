<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('matches', function(Blueprint $table) {
			$table->increments('id');
			//User Location
			$table->integer('user_id')->unique();	// restrict one match per user
			$table->integer('max_distance');
			$table->integer('minAge');
			$table->integer('maxAge');
			$table->integer('minPrice');
			$table->integer('maxPrice');
			$table->string('comment', 200);
			$table->char('gender', 1);
			$table->timestamp('start_time');
			$table->timestamp('end_time');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('matches');
	}

}

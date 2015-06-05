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
			$table->integer('max_distance')->nullable();
			$table->integer('min_age')->nullable();
			$table->integer('max_age')->nullable();
			$table->integer('min_price')->nullable();
			$table->integer('max_price')->nullable();
			$table->string('comment', 200)->nullable();
			$table->char('gender', 1)->nullable();
			$table->timestamp('start_time')->nullable();
			$table->timestamp('end_time')->nullable();
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

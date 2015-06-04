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
			$table->integer('userId')->unique();	// restrict one match per user
			$table->integer('maxDistance')->nullable();
			$table->integer('minAge')->nullable();
			$table->integer('maxAge')->nullable();
			$table->integer('minPrice')->nullable();
			$table->integer('maxPrice')->nullable();
			$table->string('comment', 200)->nullable();
			$table->char('gender', 1)->nullable();
			$table->timestamp('startTime')->nullable();
			$table->timestamp('endTime')->nullable();
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

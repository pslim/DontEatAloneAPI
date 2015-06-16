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
			$table->integer('user_id')->unique();
			$table->decimal('longitude', 9, 6);
			$table->decimal('latitude', 9, 6);
			$table->integer('max_distance');
			$table->integer('min_age');
			$table->integer('max_age');
			$table->integer('min_price');
			$table->integer('max_price');
			$table->char('gender', 1);
			$table->string('comment', 200)->nullable();
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

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('profiles', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->string('name')->nullable();
			$table->string('image_url')->nullable();
			$table->char('gender', 1)->nullable();
			$table->integer('age')->nullable();
			$table->integer('likes')->nullable();
			$table->integer('dislikes')->nullable();
			$table->longText('description')->nullable();
			$table->timestamps();
		});
	}


	/* TODO: Change age to birthdate
		object oriented
		$from = new DateTime('1970-02-01');
		$to   = new DateTime('today');
		echo $from->diff($to)->y;

		# procedural
		echo date_diff(date_create('1970-02-01'), date_create('today'))->y;
	 */

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('profiles');
	}

}

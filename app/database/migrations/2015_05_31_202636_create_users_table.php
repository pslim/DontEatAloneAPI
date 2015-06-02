<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('users', function(Blueprint $table) {
			//Note: string is VARCHAR,  $table->string('name', 100)

			$table->increments('id');
			$table->string('email')->unique();
			$table->string('password');
			//Facebook
			$table->string('name');
			$table->string('image_url');
			$table->char('gender', 1);
			$table->integer('age');
			$table->integer('rating');
			$table->longText('description');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('users');
	}

}

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
			$table->char('remember_token', 100)->nullable();
			$table->integer('facebook_id')->nullable();
			$table->string('gcm_token')->nullable();
			$table->timestamps();

			//TODO: Figure out which fields we want nullable
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

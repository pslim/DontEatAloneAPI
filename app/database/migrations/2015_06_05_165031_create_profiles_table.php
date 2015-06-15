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

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('profiles');
	}

}

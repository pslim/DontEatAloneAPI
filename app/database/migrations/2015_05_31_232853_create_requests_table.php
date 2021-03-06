<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('requests', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id');		//	sender
			$table->integer('to_user_id');	//	receiver
			$table->integer('match_id');
			//add new boolean column for accepted
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('requests');
	}

}

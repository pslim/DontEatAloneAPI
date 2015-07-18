<?php

class UsersTableSeeder extends Seeder {

	public function run() {

		Eloquent::unguard();	// to fill all fields

		$faker = Faker\Factory::create();
		$faker->seed(1234);

		for ( $i = 0; $i < 1000; $i++ ) {
			$id = $i + 1;

			User::create([
				'email'		=>	"testing" . $id . "@gmail.com",
				'password'	=>	Hash::make('Password')	
			]);
		}

	}
}
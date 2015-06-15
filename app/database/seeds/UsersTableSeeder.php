<?php

class UsersTableSeeder extends Seeder {

	public function run() {

		Eloquent::unguard();	// to fill all fields

		$faker = Faker\Factory::create();
		$faker->seed(1234);

		for ( $i = 0; $i < 200; $i++ ) {
			User::create([
				'email'		=>	$faker->email,
				'password'	=>	Hash::make('Password')	
			]);
		}

	}
}
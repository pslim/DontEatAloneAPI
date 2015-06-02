<?php

class UsersTableSeeder extends Seeder {

	public function run() {

		Eloquent::unguard();	// to fill all fields

		$faker = Faker\Factory::create();
		$faker->seed(1234);


		User::create([
			'email'			=>	'pslim@uwaterloo.ca',
			'password'		=>	Hash::make('Password'),	
			'name'			=>	'Paige',
			'image_url'		=>	$faker->imageUrl(640, 480, 'cats'),
			'gender'		=>	'F',
			'age'			=>	22,
			'rating'		=>	77,
			'description'	=>	'Hellooooo'
		]);

		for ( $i = 0; $i < 200; $i++ ) {
			User::create([
				'email'			=>	$faker->email,
				'password'		=>	Hash::make($faker->word),	
				'name'			=>	$faker->name,
				'image_url'		=>	$faker->imageUrl(640, 480, 'cats'),
				'gender'		=>	$faker->randomElement(array('M', 'F')),
				'age'			=>	$faker->numberBetween(10, 60),
				'rating'		=>	$faker->numberBetween(0, 100),
				'description'	=>	$faker->paragraph(3)
			]);
		}

	}
}
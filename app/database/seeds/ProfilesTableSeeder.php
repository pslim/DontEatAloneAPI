<?php

class ProfilesTableSeeder extends Seeder {

	public function run() {
		Eloquent::unguard();

		$faker = Faker\Factory::create();
		$faker->seed(1234);

		for ( $i = 1; $i < 1000; $i++ ) {
			Profile::create([
				'user_id'		=>	$i,
				'name'			=>	$faker->name,
				// 'image_url'		=>	$faker->imageUrl(64, 64, 'cats', $i),
				'image_url'		=>	'http://lorempixel.com/800/400/cats/'.$i,
				'gender'		=>	$faker->randomElement(['M', 'F']),
				'age'			=>	$faker->numberBetween(10, 60),
				'likes'			=>	$faker->numberBetween(0, 100),
				'dislikes'		=>	$faker->numberBetween(0, 100),
				'description'	=>	$faker->paragraph(3)
			]);
		}
	}
}
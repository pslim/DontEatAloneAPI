<?php

class ProfilesTableSeeder extends Seeder {

	public function run() {
		Eloquent::unguard();

		$faker = Faker\Factory::create();
		$faker->seed(1234);

		for ( $i = 1; $i < 200; $i++ ) {
			Profile::create([
				'user_id'		=>	$i,
				'name'			=>	$faker->name,
				'image_url'		=>	$faker->imageUrl(640, 480, 'cats'),
				'gender'		=>	$faker->randomElement(['M', 'F']),
				'age'			=>	$faker->numberBetween(10, 60),
				'likes'			=>	$faker->numberBetween(0, 100),
				'dislikes'		=>	$faker->numberBetween(0, 100),
				'description'	=>	$faker->paragraph(3)
			]);
		}
	}
}
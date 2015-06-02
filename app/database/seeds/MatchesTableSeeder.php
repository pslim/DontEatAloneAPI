<?php

class MatchesTableSeeder extends Seeder {

	public function run() {

		Eloquent::unguard();	// to fill all fields

		$faker = Faker\Factory::create();
		$faker->seed(1234);

		for ( $i = 0; $i < 200; $i++ ) {
			Match::create([
				'user_id'		=>	$i,
				'max_distance'	=>	$faker->numberBetween(0, 500),
				'minAge'		=>	$faker->numberBetween(10, 20),
				'maxAge'		=>	$faker->numberBetween(21, 60),
				'minPrice'		=>	$faker->numberBetween(0, 10),
				'maxPrice'		=>	$faker->numberBetween(11, 100),
				'comment'		=>	$faker->sentence(10),
				'gender'		=>	$faker->randomElement(array('M', 'F')),
				'start_time'	=>	$faker->dateTimeBetween('now', 'now'),
				'end_time'		=>	$faker->dateTimeBetween('now', '+1 days')
			]);
		}

	}
}
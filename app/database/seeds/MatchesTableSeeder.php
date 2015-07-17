<?php

class MatchesTableSeeder extends Seeder {

	public function run() {

		Eloquent::unguard();	// to fill all fields

		$faker = Faker\Factory::create();
		$faker->seed(1234);

		for ( $i = 1; $i < 1000; $i++ ) {
			Match::create([
				'user_id'		=>	$i,
				'latitude'		=>	$faker->latitude,
				'longitude'		=>	$faker->longitude,
				'max_distance'	=>	$faker->numberBetween(1000, 10000),
				'min_age'		=>	$faker->numberBetween(10, 20),
				'max_age'		=>	$faker->numberBetween(21, 60),
				'min_price'		=>	$faker->numberBetween(0, 10),
				'max_price'		=>	$faker->numberBetween(11, 100),
				'comment'		=>	$faker->sentence(10),
				'gender'		=>	$faker->randomElement(array('M', 'F')),
				'start_time'	=>	$faker->dateTimeBetween('now', 'now'),
				'end_time'		=>	$faker->dateTimeBetween('now', '+1 days')
			]);
		}

	}
}
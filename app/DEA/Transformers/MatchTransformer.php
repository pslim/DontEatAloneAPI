<?php namespace DEA\Transformers;

class MatchTransformer extends Transformer {

	/**
	 * Transform a match
	 *
	 * Purpose of this is so that the client will not have to 
	 * deal with parameter modifications from the database and
	 * to only display relevant information
	 *
	 * @param $match
	 * @return array
	 */
	public function transform($match) {
		$user = $match['user'];
		$profile = $user['profile'];

		return [
			'user_id'		=>	$match['user_id'],
			'max_distance'	=>	$match['max_distance'],
			'min_age'		=>	$match['min_age'],
			'max_age'		=>	$match['max_age'],
			'min_price'		=>	$match['min_price'],
			'max_price'		=>	$match['max_price'],
			'comment'		=>	$match['comment'],
			'gender'		=>	$match['gender'],
			'start_time'	=>	$match['start_time'],
			'end_time'		=>	$match['end_time'],
			'user'  		=> [
				'id' 		=>	$user['id'],
				'email' 	=>	$user['email'],
				'profile' 	=>	[
					'id' 		=>	$profile['id'],
					'user_id' 	=>	$profile['user_id'],
					'name' 		=>	$profile['name'],
					'image_url' =>	$profile['image_url'],
					'gender' 	=>	$profile['gender'],
					'rating' 	=>	$profile['rating']
				]
			]
		];
	}

}
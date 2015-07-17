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

		$data = [
			'id'			=>	$match['id'],
			'user_id'		=>	$match['user_id'],
			'facebook_id' 	=>	$user['facebook_id'],
			'max_distance'	=>	$match['max_distance'],
			'latitude'		=>	$match['latitude'],
			'longitude'		=>	$match['longitude'],
			'distance'		=>	$match['distance'],
			'min_age'		=>	$match['min_age'],
			'max_age'		=>	$match['max_age'],
			'min_price'		=>	$match['min_price'],
			'max_price'		=>	$match['max_price'],
			'comment'		=>	$match['comment'],
			'gender'		=>	$match['gender'],
			'start_time'	=>	$match['start_time'],
			'end_time'		=>	$match['end_time'],
				'profile' 	=>	[
					'id' 		=>	$profile['id'],
					'user_id' 	=>	$profile['user_id'],
					'name' 		=>	$profile['name'],
					'image_url' =>	$profile['image_url'],
					'gender' 	=>	$profile['gender'],
					'likes'		=>	$profile['likes'],
					'dislikes'	=>	$profile['dislikes']
				]
		];

		if ($data['distance'] == null) {
			unset($data['distance']);
		}

		return $data;
	}

}
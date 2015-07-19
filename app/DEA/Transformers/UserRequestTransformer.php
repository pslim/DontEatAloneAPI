<?php namespace DEA\Transformers;

class UserRequestTransformer extends Transformer {

	/**
	 * Transform a request
	 *
	 * Purpose of this is so that the client will not have to 
	 * deal with parameter modifications from the database and
	 * to only display relevant information
	 *
	 * @param $request
	 * @return array
	 */
	public function transform($request) {
		$user = $request['user'];
		$profile = $user['profile'];
		$match = $request['match'];

		return [
			'id'			=>	$request['id'],
			'user_id'		=>	$request['user_id'],
			'to_user_id'	=>	$request['to_user_id'],
			'match_id'		=>	$request['match_id'],
			'match'	=>	[
				'id'			=>	$match['id'],
				'latitude'		=>	$match['latitude'],
				'longitude'		=>	$match['longitude'],
				'max_distance'	=>	$match['max_distance'],
				'min_age'		=>	$match['min_age'],
				'max_age'		=>	$match['max_age'],
				'min_price'		=>	$match['min_price'],
				'max_price'		=>	$match['max_price'],
				'gender'		=>	$match['gender'],
				'comment'		=>	$match['comment'],
				'start_time'	=>	$match['start_time'],
				'end_time'		=>	$match['end_time']
			],
			'profile'	=>	[
				'id'	=>	$profile['id'],
				'user_id'	=>	$profile['user_id'],
				'name'	=>	$profile['name'],
				'image_url'	=>	$profile['image_url'],
				'gender'	=>	$profile['gender'],
				'age'	=>	$profile['age'],
				'likes'	=>	$profile['likes'],
				'dislikes'	=>	$profile['dislikes'],
				'description'	=>	$profile['description']
			]
		];
	}

}
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

		return [
			'id'			=>	$request['id'],
			'user_id'		=>	$request['user_id'],
			'to_user_id'	=>	$request['to_user_id'],
			'match'	=>	[
				'latitude'		=>	$request['latitude'],
				'longitude'		=>	$request['longitude'],
				'max_distance'	=>	$request['max_distance'],
				'min_age'		=>	$request['min_age'],
				'max_age'		=>	$request['max_age'],
				'min_price'		=>	$request['min_price'],
				'max_price'		=>	$request['max_price'],
				'gender'		=>	$request['gender'],
				'comment'		=>	$request['comment'],
				'start_time'	=>	$request['start_time'],
				'end_time'		=>	$request['end_time']
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
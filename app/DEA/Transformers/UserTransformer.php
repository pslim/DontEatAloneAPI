<?php namespace DEA\Transformers;

class UserTransformer extends Transformer {

	/**
	 * Transform a user
	 *
	 * Purpose of this is so that the client will not have to 
	 * deal with parameter modifications from the database
	 *
	 * @param $user
	 * @return array
	 */
	public function transform($user) {
		$profile = $user->profile;

		return [
			'id'			=>	$user['id'],
			'email'			=>	$user['email'],
			'facebook_id'	=>	$user['facebook_id'],
			'gcm_token'		=>	$user['gcm_token'],
			'profile' => [
				'id'			=>	$profile['id'],
				'user_id' 		=>	$profile['user_id'],
				'name'			=>	$profile['name'],
				'image_url'		=>	$profile['image_url'],
				'gender'		=>	$profile['gender'],
				'age'			=>	$profile['age'],
				'likes'			=>	$profile['likes'],
				'dislikes'		=>	$profile['dislikes'],
				'description'	=>	$profile['description']
			]
		];
	}

}
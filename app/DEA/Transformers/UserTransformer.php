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
			'profile' => [
				'id'			=>	$profile['id'],
				'user_id' 		=>	$profile['user_id'],
				'name'			=>	$profile['name'],
				'image_url'		=>	$profile['image_url'],
				'gender'		=>	$profile['gender'],
				'age'			=>	$profile['age'],
				'description'	=>	$profile['description']
			]
		];
	}

}
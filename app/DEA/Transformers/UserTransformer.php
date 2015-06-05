<?php namespace DEA\Transformers;

class UserTransformer extends Transformer {

	/**
	 *	Transform a lesson
	 *
	 *	Purpose of this is so that the client will not have to 
	 *	deal with parameter modifications from the database
	 *
	 *	@param $user
	 *	@return array
	 */
	public function transform($user) {
		return [
			'id'			=>	$user['id'],
			'email'			=>	$user['email'],
			'name'			=>	$user['name'],
			'imageUrl'		=>	$user['image_url'],
			'gender'		=>	$user['gender'],
			'age'			=>	$user['age'],
			'rating'		=>	$user['rating'],
			'description'	=>	$user['description']
		];
	}

}
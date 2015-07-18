<?php namespace DEA\Transformers;

class MessageTransformer extends Transformer {

	/**
	 * Transform a message
	 *
	 * Purpose of this is so that the client will not have to 
	 * deal with parameter modifications from the database
	 *
	 * @param $message
	 * @return array
	 */
	public function transform($message) {
		$user = $message['user'];
		$profile = $user['profile'];

		return [
			'id'			=>	$message['id'],
			'user_id'		=>	$message['user_id'],
			'to_user_id'	=>	$message['to_user_id'],
			'created_at'	=>	$message['created_at'],
			'profile'	=>	[
				'user_id'			=>	$profile['user_id'],
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
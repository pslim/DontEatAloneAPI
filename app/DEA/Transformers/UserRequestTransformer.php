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
		return [
			'id'			=>	$request['id'],
			'user_id'		=>	$request['user_id'],
			'to_user_id'	=>	$request['to_user_id']
		];
	}

}
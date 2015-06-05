<?php namespace DEA\Transformers;

class MatchTransformer extends Transformer {

	/**
	 * Transform a lesson
	 *
	 * Purpose of this is so that the client will not have to 
	 * deal with parameter modifications from the database
	 *
	 * @param $match
	 * @return array
	 */
	public function transform($match) {
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
			'end_time'		=>	$match['end_time']
		];
	}

}
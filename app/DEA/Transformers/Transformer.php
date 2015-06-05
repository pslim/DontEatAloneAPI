<?php namespace DEA\Transformers;

abstract class Transformer {

	/**
	 * Transform a collection of users
	 *
	 * Purpose of this is so that the client will not have to 
	 * deal with parameter modifications from the database
	 *
	 * @param $users
	 * @return array
	 */
	public function transformCollection(array $items) {
		return array_map([$this, 'transform'], $items);
	}

	public abstract function transform($item);
}
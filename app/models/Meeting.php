<?php


class Meeting extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'meetings';

	protected $fillable = [
		'user_id1',
		'user_id2'
	];
}

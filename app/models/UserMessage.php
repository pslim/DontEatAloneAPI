<?php


class UserMessage extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'messages';

	protected $fillable = [
		'user_id',
		'to_user_id',
		'message',
	];

	public function user() {
		return $this->belongsTo('User');
	}
}

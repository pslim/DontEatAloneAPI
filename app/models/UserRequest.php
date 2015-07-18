<?php


class UserRequest extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'requests';

	protected $fillable = [
		'user_id',
		'to_user_id',
		'match_id'
	];

	public function user() {
		return $this->belongsTo('User');
	}

	public function match() {
		return $this->belongsTo('Match');
	}
}

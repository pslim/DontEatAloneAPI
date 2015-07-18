<?php


class Match extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'matches';

	protected $fillable = [
		'user_id',
		'latitude',
		'longitude',
		'max_distance',
		'min_age',
		'max_age',
		'min_price',
		'max_price',
		'comment',
		'gender',
		'start_time',
		'end_time'
	];

	public function user() {
		return $this->belongsTo('User');
	}

	public function userRequest() {
		return $this->hasOne('UserRequest');
	}
}

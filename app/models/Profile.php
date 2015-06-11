<?php

class Profile extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'profiles';

	protected $fillable = [
		'name',
		'image_url',
		'gender',
		'age',
		'description'
	];

	public function user() {
		return $this->belongsTo('User');
	}

}
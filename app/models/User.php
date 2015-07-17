<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	protected $fillable = [
		'email', 
		'password',
		'facebook_id',
		'name',
		'gender',
		'age',
		'image_url',
		'description',
		'gcm_token'
	];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');


	public function profile() {
		return $this->hasOne('Profile');
	}

	public function matches() {
		return $this->hasMany('Match');	//might be belongsToOne
	}
}

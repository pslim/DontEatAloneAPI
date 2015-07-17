<?php namespace DEA\Forms;

use Laracasts\Validation\FormValidator;

class UserForm extends FormValidator {

	/**
	 * Validation rules for creating a match
	 *
	 * @var array
	 */

	protected $rules = [
		'email'					=>	'required|email|unique:users',
		'password'				=>	'required',
		'password_confirmation'	=>	'required',
		'facebook_id'			=>	'',	//TODO: Integer?,
		'gcm_token'				=>	'' //TODO: string?
	];

}
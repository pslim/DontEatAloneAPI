<?php namespace DEA\Forms;

use Laracasts\Validation\FormValidator;

class RequestForm extends FormValidator {

	/**
	 * Validation rules for creating a Request
	 *
	 * @var array
	 */

	protected $rules = [
		'user_id'		=>	'required|exists:users,id',
		'to_user_id'	=>	'required|exists:users,id'
	];

	// TODO: Do more error checking later
}
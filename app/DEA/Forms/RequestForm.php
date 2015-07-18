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
		'to_user_id'	=>	'required|exists:users,id',
		'match_id'		=>	'required|exists:matches,id'
	];

	// TODO: Do more error checking later
	// Check that the user ids are not the same
}
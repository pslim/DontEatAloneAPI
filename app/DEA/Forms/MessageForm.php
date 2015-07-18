<?php namespace DEA\Forms;

use Laracasts\Validation\FormValidator;

class MessageForm extends FormValidator {

	/**
	 * Validation rules for creating a match
	 *
	 * @var array
	 */

	protected $rules = [
		'user_id'		=>	'required|exists:users,id',
		'to_user_id'	=>	'required|exists:users,id',
		'message'		=>	'string'
	];

	//TODO: Minor, rule that checks that user_id and to_user_id are not the same
}
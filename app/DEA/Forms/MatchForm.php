<?php namespace DEA\Forms;

use Laracasts\Validation\FormValidator;

class MatchForm extends FormValidator {

	/**
	 * Validation rules for creating a match
	 *
	 * @var array
	 */

	protected $rules = [
		'user_id'		=>	'required|exists:users,id|unique:matches',
		// 'longitude'		=>	'',
		// 'latitude'		=>	'',
		'max_distance'	=>	'required|integer|min:0',
		'min_age'		=>	'required|integer|min:0|max:120',
		'max_age'		=>	'required|integer|min:0|max:120',	//TODO: Create custom validation rule for 'greater_than'
		'min_price'		=>	'required|integer|min:0',
		'max_price'		=>	'required|integer|min:0',
		'gender'		=>	'required|in:M,F',
		//TODO: Fix these 2 rules:
		// 'start_time'	=>	'required|date_format:Y-m-d h:i:s',	//TODO: Check start_time is after current time
		// 'end_time'		=>  'required|date_format:Y-m-d h:i:s',	//TODO: Check end_time is after start_time
		'comment'		=>	'string:200'
	];

}
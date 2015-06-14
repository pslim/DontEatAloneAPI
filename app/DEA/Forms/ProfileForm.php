<?php namespace DEA\Forms;

use Laracasts\Validation\FormValidator;

class ProfileForm extends FormValidator {

	protected $rules = [
		'name'			=>	'string',	//TODO: Might be required
		'image_url'	 	=>	'string',	//TODO: Check for url
		'gender'		=>	'in:M,F',	//TODO: Might be required
		'age'			=>	'integer',	//TODO: Might be required
		'description'	=>	'string'
	];

}
<?php namespace Alpha\Forms;

use Laracasts\Validation\FormValidator;

class UserAddClientsForm extends FormValidator
{
	protected $rules = [
		'selectedClients' => 'required'
	];


}
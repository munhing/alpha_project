<?php namespace Alpha\Forms;

use Laracasts\Validation\FormValidator;

class CertificateAddItemsForm extends FormValidator
{
	protected $rules = [
		'selectedItems' => 'required'
	];


}
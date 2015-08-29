<?php namespace Alpha\Forms;

use Laracasts\Validation\FormValidator;

class ReportAddItemsForm extends FormValidator
{
	protected $rules = [
		'selectedItems' => 'required'
	];


}
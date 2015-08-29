<?php namespace Alpha\Forms;

use Laracasts\Validation\FormValidator;

class ReportAddCertificatesForm extends FormValidator
{
	protected $rules = [
		'selectedCerts' => 'required'
	];


}
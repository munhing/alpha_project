<?php namespace Alpha\Forms;

use Laracasts\Validation\FormValidator;

class ReportTypeForm extends FormValidator
{
	protected $rules = [
		'type' => 'required | unique:type',
	];


    public function validateUpdate(array $input, $id)
    {
        $this->rules['type'] .= ',type,'.$id;
        return $this->validate($input);
    }
}
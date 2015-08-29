<?php namespace Alpha\Forms;

use Laracasts\Validation\FormValidator;

class ItemForm extends FormValidator
{
	protected $rules = [
		'serial_no' => 'required | unique:items'
	];

    public function validateUpdate(array $input, $id)
    {
        $this->rules['serial_no'] .= ',serial_no,'.$id;
        return $this->validate($input);
    }
}
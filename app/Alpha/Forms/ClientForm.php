<?php namespace Alpha\Forms;

use Laracasts\Validation\FormValidator;

class ClientForm extends FormValidator
{
	protected $rules = [
		'name' => 'required | unique:clients'
	];

    public function validateUpdate(array $input, $id)
    {
        $this->rules['name'] .= ',name,'.$id;
        return $this->validate($input);
    }
}
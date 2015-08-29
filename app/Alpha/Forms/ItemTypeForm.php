<?php namespace Alpha\Forms;

use Laracasts\Validation\FormValidator;

class ItemTypeForm extends FormValidator
{
	protected $rules = [
		'type' => 'required | unique:item_type'
	];

    public function validateUpdate(array $input, $id)
    {
        $this->rules['type'] .= ',type,'.$id;
        return $this->validate($input);
    }
}
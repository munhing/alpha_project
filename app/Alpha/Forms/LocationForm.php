<?php namespace Alpha\Forms;

use Laracasts\Validation\FormValidator;

class LocationForm extends FormValidator
{
	protected $rules = [
		'location' => 'required',
        'client_id' => 'required'
	];

    public function validateUpdate(array $input, $id)
    {
        return $this->validate($input);
    }
}
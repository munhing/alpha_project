<?php namespace Alpha\Forms;

use Laracasts\Validation\FormValidator;

class CertificateTypeForm extends FormValidator
{
	protected $rules = [
		'type' => 'required | unique:certificate_type'
	];

    public function validateUpdate(array $input, $id)
    {
        $this->rules['type'] .= ',type,'.$id;
        return $this->validate($input);
    }
}
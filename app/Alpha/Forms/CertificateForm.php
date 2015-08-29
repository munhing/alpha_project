<?php namespace Alpha\Forms;

use Laracasts\Validation\FormValidator;

class CertificateForm extends FormValidator
{
	protected $rules = [
		'cert_no' => 'required | unique:certificates',
		'date' => 'required | date_format:"d/m/Y"',
		'validity' => 'required | integer'
	];

    public function validateUpdate(array $input, $id)
    {
        $this->rules['cert_no'] .= ',cert_no,'.$id;
        return $this->validate($input);
    }
}
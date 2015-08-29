<?php namespace Alpha\Forms;

use Laracasts\Validation\FormValidator;

class ReportForm extends FormValidator
{

    protected $rules = [
		'report_no' => 'required | unique:reports',
		'date' => 'required | date_format:"d/m/Y"',
		'validity' => 'required | integer'
    ];


    public function validateUpdate(array $input, $id)
    {
        $this->rules['report_no'] .= ',report_no,'.$id;
        return $this->validate($input);
    }



}
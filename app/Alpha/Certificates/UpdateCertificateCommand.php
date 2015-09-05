<?php namespace Alpha\Certificates;

class UpdateCertificateCommand {

	public $id;
	public $cert_no;
	public $certificate_type_id;
	public $client_id;
	public $validity;
	public $date;
	public $next_inspection;
	public $file;
	public $filename;
	public $location_id;

    public function __construct($id, $cert_no, $certificate_type_id, $client_id, $validity, $date, $file, $filename, $location_id)
    {

		$this->id 					= $id;
		$this->cert_no 				= $cert_no;
		$this->certificate_type_id 	= $certificate_type_id;
		$this->client_id 			= $client_id;
		$this->validity 			= $validity;
		$this->date 				= convertToMySQLDate($date);
		$this->next_inspection 		= getNextInspection($date, $validity);
		$this->file 				= $file;
		$this->filename				= $filename;
		$this->location_id 			= $location_id;
    }

}
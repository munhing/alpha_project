<?php

use Laracasts\Commander\Events\EventGenerator;
use Alpha\Certificates\Events\CertificateWasRegistered;
use Alpha\Certificates\Events\CertificateWasUpdated;

class Certificate extends Eloquent implements SearchInterface{

	use EventGenerator;
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'certificates';

	protected $fillable = array('cert_no', 'certificate_type_id', 'client_id', 'location_id', 'validity', 'date', 'next_inspection', 'filename');

	protected $dates = array('date', 'next_inspection');

	public function reports()
	{
		return $this->belongsToMany('Report');
	}

	public function items()
	{
		return $this->belongsToMany('Item', 'certificate_item');
	}

	public function client()
	{
		return $this->belongsTo('Client');
	}

	public function location()
	{
		return $this->belongsTo('Location');
	}

	public function certificateType()
	{
		return $this->belongsTo('CertificateType');
	}

	public static function register($cert_no, $certificate_type_id, $client_id, $validity, $date, $next_inspection, $filename = '')
	{
		$certificate = new static(compact('cert_no', 'certificate_type_id', 'client_id', 'validity', 'date', 'next_inspection', 'filename'));

		$certificate->raise(new CertificateWasRegistered($certificate));

		return $certificate;
	}	

	public static function edit($id, $cert_no, $certificate_type_id, $client_id, $location_id, $validity, $date, $next_inspection, $filename)
	{
		$certificate = static::find($id);

		$certificate->cert_no 			 	= $cert_no;
		$certificate->certificate_type_id 	= $certificate_type_id;
		$certificate->client_id 			= $client_id;
		$certificate->location_id 			= $location_id;
		$certificate->validity 			 	= $validity;
		$certificate->date 				 	= $date;
		$certificate->next_inspection 	 	= $next_inspection;
		$certificate->filename 			 	= $filename;

		$certificate->raise(new CertificateWasUpdated($certificate));

		return $certificate;
	}	

	public function getReportingType()
	{
		if($this->certificate_type_id != 0) {
			return $this->certificateType->type;
		}

		return '-';
	}

	public function getSearchName()
	{
		return $this->cert_no;
	}

	public function getSearchUrl()
	{
		return 'certificates.show';
	}

	public function getReportingNo()
	{
		return $this->cert_no;
	}	

	public function getReportingUrl()
	{
		return 'certificates.show';
	}

	public function getClientReportingUrl()
	{
		return 'client_certificate_show';
	}
		
	public function getClientName()
	{
		return $this->client->name;
	}	

	public function getType()
	{
		return 'Certificate';
	}	
}

<?php

use Laracasts\Commander\Events\EventGenerator;
use Alpha\CertificateTypes\Events\CertificateTypeWasRegistered;
use Alpha\CertificateTypes\Events\CertificateTypeWasUpdated;

class CertificateType extends \Eloquent {

	use EventGenerator;

	protected $table = 'certificate_type';

	protected $fillable = ['type'];

	public function certificates()
	{
		return $this->hasMany('Certificate', 'certificate_type_id', 'id');
	}

	public static function register($type)
	{
		$certificateType = new static(compact('type'));

		$certificateType->raise(new CertificateTypeWasRegistered($certificateType));

		return $certificateType;
	}		

	public static function edit($id, $type)
	{
		$certificateType = static::find($id);

		$certificateType->type = $type;

		$certificateType->raise(new CertificateTypeWasUpdated($certificateType));

		return $certificateType;
	}

}
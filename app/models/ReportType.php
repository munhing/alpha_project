<?php

use Laracasts\Commander\Events\EventGenerator;
use Alpha\Reports\Events\ReportTypeWasRegistered;
use Alpha\Reports\Events\ReportTypeWasUpdated;

class ReportType extends Eloquent {

	use EventGenerator;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'type';

	protected $fillable = array('type');

	public function reports()
	{
		return $this->hasMany('Report', 'type', 'type');
	}

	public static function register($type)
	{
		$reportType = new static(compact('type'));

		$reportType->raise(new ReportTypeWasRegistered($reportType));

		return $reportType;
	}		

	public static function edit($id, $type)
	{
		$reportType = static::find($id);

		$reportType->type = $type;

		$reportType->raise(new ReportTypeWasUpdated($reportType));

		return $reportType;
	}	
}

<?php

use Laracasts\Commander\Events\EventGenerator;
use Alpha\Reports\Events\ReportWasRegistered;
use Alpha\Reports\Events\ReportWasUpdated;

class Report extends Eloquent implements SearchInterface{

	use EventGenerator;
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'reports';

	protected $guarded = array('id', 'created_at', 'updated_at');

	protected $dates = array('date', 'next_inspection');


	public function client()
	{
		return $this->belongsTo('Client');
	}

	public function items()
	{
		return $this->belongsToMany('Item', 'item_report');
	}

	public function certificates()
	{
		return $this->belongsToMany('Certificate');
	}

	public function reportType()
	{
		return $this->belongsTo('ReportType');
	}
	
	public static function register($report_no, $type, $client_id, $validity, $date, $next_inspection, $filename = '')
	{
		$report = new static(compact('report_no', 'type', 'client_id', 'validity', 'date', 'next_inspection', 'filename'));

		$report->raise(new ReportWasRegistered($report));

		return $report;
	}		

	public static function edit($id, $report_no, $type, $client_id, $validity, $date, $next_inspection, $filename)
	{
		$report = static::find($id);

		$report->report_no 			= $report_no;
		$report->type 				= $type;
		$report->client_id 			= $client_id;
		$report->validity 			= $validity;
		$report->date 				= $date;
		$report->next_inspection 	= $next_inspection;
		$report->filename 			= $filename;

		$report->raise(new ReportWasUpdated($report));

		return $report;
	}	

	public function getSearchName()
	{
		return $this->report_no;
	}

	public function getReportingType()
	{
		return $this->type;
	}


	public function getSearchUrl()
	{
		return 'reports.show';
	}
	
	public function getReportingNo()
	{
		return $this->report_no;
	}	

	public function getReportingUrl()
	{
		return 'reports.show';
	}

	public function getClientReportingUrl()
	{
		return 'client_report_show';
	}

	public function getClientName()
	{
		return $this->client->name;
	}

	public function getType()
	{
		return 'Report';
	}	
}

<?php namespace Alpha\Reports;

class UpdateReportCommand {

	public $id;
	public $report_no;
	public $type;
	public $client_id;
	public $validity;
	public $date;
	public $next_inspection;
	public $file;
	public $filename;

    public function __construct($id, $report_no, $type, $client_id, $validity, $date, $file, $filename)
    {

		$this->id 			= $id;
		$this->report_no 	= $report_no;
		$this->type 		= $type;
		$this->client_id 	= $client_id;
		$this->validity 	= $validity;
		$this->date 		= convertToMySQLDate($date);
		$this->next_inspection = getNextInspection($date, $validity);
		$this->file 		= $file;
		$this->filename		= $filename;
    }

}
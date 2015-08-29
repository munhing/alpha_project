<?php namespace Alpha\Reports\Events;

use Report;

class ReportWasUpdated {

    public $report;

    public function __construct(Report $report) /* or pass in just the relevant fields */
    {
        $this->report = $report;
    }

}
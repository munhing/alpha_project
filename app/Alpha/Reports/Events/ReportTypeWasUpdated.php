<?php namespace Alpha\Reports\Events;

use ReportType;

class ReportTypeWasUpdated {

    public $reportType;

    public function __construct(ReportType $reportType) /* or pass in just the relevant fields */
    {
        $this->reportType = $reportType;
    }

}
<?php namespace Alpha\Reports;

class RegisterReportTypeCommand {

    /**
     * @var string
     */
    public $type;

    /**
     * @param string type
     */
    public function __construct($type)
    {
        $this->type = $type;
    }

}
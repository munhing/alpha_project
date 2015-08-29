<?php namespace Alpha\Reports;

class UpdateReportTypeCommand {

    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $type;

    /**
     * @param string id
     * @param string type
     */
    public function __construct($id, $type)
    {
        $this->id = $id;
        $this->type = $type;
    }

}
<?php namespace Alpha\Locations;

class UpdateLocationCommand {

    /**
     * @var string
     */
    public $id;
    public $location;
    public $client_id;

    /**
     * @param string type
     */
    public function __construct($id, $location, $client_id)
    {
        $this->id = $id;
        $this->location = $location;
        $this->client_id = $client_id;
    }

}
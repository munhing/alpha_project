<?php namespace Alpha\Locations;

class RegisterLocationCommand {

    /**
     * @var string
     */
    public $location;
    public $client_id;

    /**
     * @param string type
     */
    public function __construct($location, $client_id)
    {
        $this->location = $location;
        $this->client_id = $client_id;
    }

}
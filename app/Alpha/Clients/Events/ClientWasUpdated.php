<?php namespace Alpha\Clients\Events;

use Client;

class ClientWasUpdated {

    public $client;

    public function __construct(Client $client) /* or pass in just the relevant fields */
    {
        $this->client = $client;
    }

}
<?php namespace Alpha\Clients;

class RegisterClientCommand {

	public $name;
    /**
     */
    public function __construct($name)
    {
    	$this->name = $name;
    }

}
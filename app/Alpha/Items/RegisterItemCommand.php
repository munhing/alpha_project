<?php namespace Alpha\Items;

class RegisterItemCommand {

	public $serial_no;
	public $item_type_id;
	public $client_id;
	public $description;
    /**
     */
    public function __construct($serial_no, $item_type_id, $client_id, $description)
    {
    	$this->serial_no = $serial_no;
    	$this->item_type_id = $item_type_id;
    	$this->client_id = $client_id;
    	$this->description = $description;
    }

}
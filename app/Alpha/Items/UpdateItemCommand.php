<?php namespace Alpha\Items;

class UpdateItemCommand {

	public $id;
	public $serial_no;
	public $item_type_id;
	public $client_id;
	public $description;
    public $location_id;
    /**
     */
    public function __construct($id, $serial_no, $item_type_id, $client_id, $description, $location_id)
    {
    	$this->id = $id;
    	$this->serial_no = $serial_no;
    	$this->item_type_id = $item_type_id;
    	$this->client_id = $client_id;
    	$this->description = $description;
        $this->location_id = $location_id;
    }

}
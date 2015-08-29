<?php

use Laracasts\Commander\Events\EventGenerator;
use Alpha\Items\Events\ItemWasRegistered;
use Alpha\Items\Events\ItemWasUpdated;

class Item extends Eloquent implements SearchInterface{

	use EventGenerator;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'items';

	protected $guarded = array('id', 'created_at', 'updated_at');

	public function client()
	{
		return $this->belongsTo('Client');
	}
	
	public function itemType()
	{
		return $this->belongsTo('ItemType');
	}

	public function reports()
	{
		return $this->belongsToMany('Report', 'item_report');
	}

	public function certificates()
	{
		return $this->belongsToMany('Certificate', 'certificate_item');
	}

	public static function register($serial_no, $item_type_id, $client_id, $description)
	{
		$item = new static(compact('serial_no', 'item_type_id', 'client_id', 'description'));

		$item->raise(new ItemWasRegistered($item));

		return $item;
	}		

	public static function edit($id, $serial_no, $item_type_id, $client_id, $description)
	{
		$item = static::find($id);

		$item->serial_no 	= $serial_no;
		$item->item_type_id = $item_type_id;
		$item->client_id 	= $client_id;
		$item->description 	= $description;

		$item->raise(new ItemWasUpdated($item));

		return $item;
	}

	public function getSearchName()
	{
		return $this->serial_no;
	}

	public function getSearchUrl()
	{
		return 'item_show';
	}

	public function getClientReportingUrl()
	{
		return 'client_item_show';
	}

	public function getType()
	{
		return 'Item';
	}
}

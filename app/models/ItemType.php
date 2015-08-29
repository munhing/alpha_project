<?php

use Laracasts\Commander\Events\EventGenerator;
use Alpha\Items\Events\ItemTypeWasRegistered;
use Alpha\Items\Events\ItemTypeWasUpdated;

class ItemType extends Eloquent {

	use EventGenerator;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'item_type';

	protected $fillable = array('type');

	public function items()
	{
		return $this->hasMany('Item', 'item_type_id', 'id');
	}

	public static function register($type)
	{
		$itemType = new static(compact('type'));

		$itemType->raise(new ItemTypeWasRegistered($itemType));

		return $itemType;
	}		

	public static function edit($id, $type)
	{
		$itemType = static::find($id);

		$itemType->type = $type;

		$itemType->raise(new ItemTypeWasUpdated($itemType));

		return $itemType;
	}

}

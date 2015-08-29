<?php namespace Alpha\Items\Events;

use ItemType;

class ItemTypeWasRegistered {

    public $itemType;

    public function __construct(ItemType $itemType) /* or pass in just the relevant fields */
    {
        $this->itemType = $itemType;
    }

}
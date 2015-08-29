<?php namespace Alpha\Items\Events;

use Item;

class ItemWasRegistered {

    public $item;

    public function __construct(Item $item) /* or pass in just the relevant fields */
    {
        $this->item = $item;
    }

}
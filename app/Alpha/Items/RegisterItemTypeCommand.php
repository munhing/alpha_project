<?php namespace Alpha\Items;

class RegisterItemTypeCommand {

    /**
     * @var string
     */
    public $type;

    /**
     * @param string type
     */
    public function __construct($type)
    {
        $this->type = $type;
    }

}
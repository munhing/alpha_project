<?php namespace Alpha\CertificateTypes;

class UpdateCertificateTypeCommand {

    /**
     * @var string
     */
    public $id;
    public $type;

    /**
     * @param string type
     */
    public function __construct($id, $type)
    {
        $this->id = $id;
        $this->type = $type;
    }

}
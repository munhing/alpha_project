<?php namespace Alpha\CertificateTypes;

class RegisterCertificateTypeCommand {

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
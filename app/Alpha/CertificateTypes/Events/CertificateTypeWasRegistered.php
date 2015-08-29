<?php namespace Alpha\CertificateTypes\Events;

use CertificateType;

class CertificateTypeWasRegistered {

    public $certificateType;

    public function __construct(CertificateType $certificateType) /* or pass in just the relevant fields */
    {
        $this->certificateType = $certificateType;
    }

}
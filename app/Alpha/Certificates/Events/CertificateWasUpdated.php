<?php namespace Alpha\Certificates\Events;

use Certificate;

class CertificateWasUpdated {

    public $certificate;

    public function __construct(Certificate $certificate) /* or pass in just the relevant fields */
    {
        $this->certificate = $certificate;
    }

}
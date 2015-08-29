<?php namespace Alpha\Certificates;

class RegisterCertificateCommand {

    public $cert_no;
    public $certificate_type_id;
    public $client_id;
    public $date;
    public $next_inspection;
    public $validity;
    public $file;

    public function __construct($cert_no, $certificate_type_id, $client_id, $date, $validity, $file = '')
    {
        $this->cert_no              = $cert_no;
        $this->certificate_type_id  = $certificate_type_id;
        $this->client_id            = $client_id;
        $this->date                 = convertToMySQLDate($date);
        $this->next_inspection      = getNextInspection($date, $validity);
        $this->validity             = $validity;
        $this->file                 = $file;
    }

}
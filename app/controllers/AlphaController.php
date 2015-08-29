<?php

use Alpha\Repositories\ReportsRepository;
use Alpha\Repositories\CertificatesRepository;

class AlphaController extends \BaseController {

	protected $notify = [];
	protected $reportsRepo;
	protected $certificatesRepo;

	public function __construct(ReportsRepository $reportsRepo, CertificatesRepository $certificatesRepo)
	{
		$this->reportsRepo = $reportsRepo;
		$this->certificatesRepo = $certificatesRepo;
	}	

	public function notify()
	{
		$this->notify['new_reports'] 		= $this->reportsRepo->getNewReportsCount();
		$this->notify['new_certificates'] 	= $this->certificatesRepo->getNewCertificatesCount();
		$this->notify['exp_reports'] 		= $this->reportsRepo->getExpiringReportsCount();
		$this->notify['exp_certificates'] 	= $this->certificatesRepo->getExpiringCertificatesCount();

		return $this->notify;
	}

}

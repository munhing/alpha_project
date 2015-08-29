<?php namespace Alpha\Certificates;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use Alpha\Repositories\CertificatesRepository;
use Certificate;

class UpdateCertificateCommandHandler implements CommandHandler {

	use DispatchableTrait;

	protected $certificatesRepository;

	function __construct(CertificatesRepository $certificatesRepository)
	{
		$this->certificatesRepository = $certificatesRepository;
	}

    public function handle($command)
    {
		if($command->file) {
			$file = uploadCertificateFile($command->file);
			$command->filename = $file->getFilename();
		}

		$certificate = Certificate::edit(
			$command->id,
			$command->cert_no,
			$command->certificate_type_id,
			$command->client_id,
			$command->validity,
			$command->date,
			$command->next_inspection,
			$command->filename
		);

		$this->certificatesRepository->save($certificate);

		$this->dispatchEventsFor($certificate);

		return $certificate; 
    }

}
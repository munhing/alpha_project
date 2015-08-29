<?php namespace Alpha\Certificates;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use Alpha\Repositories\CertificatesRepository;
use Certificate;

class RegisterCertificateCommandHandler implements CommandHandler {

	use DispatchableTrait;

	protected $certificatesRepository;

	function __construct(CertificatesRepository $certificatesRepository)
	{
		$this->certificatesRepository = $certificatesRepository;
	}


    /**
     * Handle the command.
     *
     * @param object $command
     * @return void
     */
    public function handle($command)
    {
    	//dd($command);

    	$filename = '';

		if($command->file) {
			$file = uploadCertificateFile($command->file);
			$filename = $file->getFilename();
		}

		//$cert_no, $certificate_type_id, $client_id, $validity, $date, $next_inspection, $filename = ''

		$certificate = Certificate::register(
			$command->cert_no,
			$command->certificate_type_id,
			$command->client_id,
			$command->validity,
			$command->date,
			$command->next_inspection,
			$filename
		);

		//dd($certificate->toArray());	

		$this->certificatesRepository->save($certificate);

		$this->dispatchEventsFor($certificate);

		return $certificate;  
    }

}
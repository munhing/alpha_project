<?php namespace Alpha\CertificateTypes;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use Alpha\Repositories\CertificateTypesRepository;
use CertificateType;

class UpdateCertificateTypeCommandHandler implements CommandHandler {

	use DispatchableTrait;

	protected $certificateTypesRepository;

	function __construct(CertificateTypesRepository $certificateTypesRepository)
	{
		$this->certificateTypesRepository = $certificateTypesRepository;
	}

    /**
     * Handle the command.
     *
     * @param object $command
     * @return void
     */
    public function handle($command)
    {
		$certificateType = CertificateType::edit(
			$command->id,
			$command->type
		);

		$this->certificateTypesRepository->save($certificateType);

		$this->dispatchEventsFor($certificateType);

		return $certificateType;
    }

}
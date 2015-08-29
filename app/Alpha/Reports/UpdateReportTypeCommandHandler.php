<?php namespace Alpha\Reports;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use Alpha\Repositories\ReportTypesRepository;
use ReportType;

class UpdateReportTypeCommandHandler implements CommandHandler {

	use DispatchableTrait;

	protected $reportTypesRepository;

	function __construct(ReportTypesRepository $reportTypesRepository)
	{
		$this->reportTypesRepository = $reportTypesRepository;
	}
    /**
     * Handle the command.
     *
     * @param object $command
     * @return void
     */
    public function handle($command)
    {

		$reportType = ReportType::edit(
			$command->id,
			$command->type
		);

		//$type->save();

		//dd('stop');
		$this->reportTypesRepository->save($reportType);

		$this->dispatchEventsFor($reportType);

		return $reportType; 
    }

}
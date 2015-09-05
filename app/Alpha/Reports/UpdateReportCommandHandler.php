<?php namespace Alpha\Reports;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use Alpha\Repositories\ReportsRepository;
use Report;

class UpdateReportCommandHandler implements CommandHandler {

	use DispatchableTrait;

	protected $reportsRepository;

	function __construct(ReportsRepository $reportsRepository)
	{
		$this->reportsRepository = $reportsRepository;
	}

    /**
     * Handle the command.
     *
     * @param object $command
     * @return void
     */
    public function handle($command)
    {

		if($command->file) {
			$file = uploadFile($command->file);
			$command->filename = $file->getFilename();
		}

		$report = Report::edit(
			$command->id,
			$command->report_no,
			$command->type,
			$command->client_id,
			$command->location_id,
			$command->validity,
			$command->date,
			$command->next_inspection,
			$command->filename
		);

		$this->reportsRepository->save($report);

		$this->dispatchEventsFor($report);

		return $report;
    }

}
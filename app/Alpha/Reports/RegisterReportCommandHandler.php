<?php namespace Alpha\Reports;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use Alpha\Repositories\ReportsRepository;
use Report;

class RegisterReportCommandHandler implements CommandHandler {

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
    	//dd($command->file->getClientOriginalName());

    	$filename = '';

		if($command->file) {
			$file = uploadFile($command->file);
			$filename = $file->getFilename();
		}

		$report = Report::register(
			$command->report_no,
			$command->type,
			$command->client_id,
			$command->validity,
			$command->date,
			$command->next_inspection,
			$filename
		);

		//dd($report);	

		$this->reportsRepository->save($report);

		$this->dispatchEventsFor($report);

		return $report;    	
    }

}
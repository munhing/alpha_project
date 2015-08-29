<?php namespace Alpha\Locations;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use Alpha\Repositories\LocationsRepository;
use Location;

class UpdateLocationCommandHandler implements CommandHandler {

	use DispatchableTrait;

	protected $locationsRepository;

	function __construct(LocationsRepository $locationsRepository)
	{
		$this->locationsRepository = $locationsRepository;
	}

    /**
     * Handle the command.
     *
     * @param object $command
     * @return void
     */
    public function handle($command)
    {
        // dd($command);
        
		$location = Location::edit(
			$command->id,
			$command->location,
            $command->client_id
		);

		$this->locationsRepository->save($location);

		return $location;
    }

}
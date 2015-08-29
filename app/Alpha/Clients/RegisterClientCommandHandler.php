<?php namespace Alpha\Clients;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use Alpha\Repositories\ClientsRepository;
use Client;

class RegisterClientCommandHandler implements CommandHandler {

	use DispatchableTrait;

	protected $clientsRepository;

	function __construct(ClientsRepository $clientsRepository)
	{
		$this->clientsRepository = $clientsRepository;
	}
    /**
     * Handle the command.
     *
     * @param object $command
     * @return void
     */
    public function handle($command)
    {

		$client = Client::register(
			$command->name
		);

		//dd($report);	

		$this->clientsRepository->save($client);

		$this->dispatchEventsFor($client);

		return $client;
    }

}
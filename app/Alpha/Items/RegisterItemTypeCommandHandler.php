<?php namespace Alpha\Items;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use Alpha\Repositories\ItemTypesRepository;
use ItemType;

class RegisterItemTypeCommandHandler implements CommandHandler {

	use DispatchableTrait;

	protected $itemTypesRepository;

	function __construct(ItemTypesRepository $itemTypesRepository)
	{
		$this->itemTypesRepository = $itemTypesRepository;
	}

    /**
     * Handle the command.
     *
     * @param object $command
     * @return void
     */
    public function handle($command)
    {
		$itemType = ItemType::register(
			$command->type
		);

		$this->itemTypesRepository->save($itemType);

		$this->dispatchEventsFor($itemType);

		return $itemType; 
    }

}
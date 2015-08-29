<?php namespace Alpha\Items;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use Alpha\Repositories\ItemsRepository;
use Item;

class UpdateItemCommandHandler implements CommandHandler {

	use DispatchableTrait;

	protected $itemsRepository;

	function __construct(ItemsRepository $itemsRepository)
	{
		$this->itemsRepository = $itemsRepository;
	}

    /**
     * Handle the command.
     *
     * @param object $command
     * @return void
     */
    public function handle($command)
    {

		$item = Item::edit(
			$command->id,
			$command->serial_no,
			$command->item_type_id,
			$command->client_id,
			$command->description
		);

		$this->itemsRepository->save($item);

		$this->dispatchEventsFor($item);

		return $item;  
    }

}
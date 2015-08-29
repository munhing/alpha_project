<?php namespace Alpha\Repositories;

use Item;
use ItemType;

class ItemsRepository
{

	/**
	 * Get all clients from db
	 *
	 * @return array of Objects
	 */	
	public function getAll()
	{
		return Item::with('itemType')->get();
	}

	public function getAllWithPagination($row = 20)
	{
		return Item::with('itemType', 'client')
				->select('items.*', 'clients.name', 'item_type.type')
		       ->join('clients', 'items.client_id', '=', 'clients.id')
		       ->join('item_type', 'items.item_type_id', '=', 'item_type.id')
		       ->orderBy('items.serial_no')
		       ->paginate($row);	
	}

	public function save(Item $item)
	{
		return $item->save();
	}

	public function getAllForSelectListByClientId($client_id)
	{
		return Item::selectRaw("id, serial_no AS text")->where('client_id', '=', $client_id)->orderBy('text')->get();
	}

	public function getById($id)
	{
		return Item::find($id);
	}

	public function getByIdWithDetails($id)
	{
			return Item::with([
						'client', 'itemType',
						'reports' => function($query){
								$query->selectRaw("reports.*, (`next_inspection`) > (NOW())  AS `status`");
							},
						'certificates' => function($query){
								$query->selectRaw("certificates.*, (`next_inspection`) > (NOW())  AS `status`");
							}				
					])->findOrFail($id);
	}
	
	public function addItem($input)
	{
		$item = new Item;
		$item->serial_no = $input['serial_no'];
		$item->item_type_id = $input['item_type_id'];
		$item->client_id = $input['client_id'];
		$item->description = $input['description'];
	
		$item->save();

		return $item;
	}

	public function updateItem($input)
	{
		$item = $this->getById($input['id']);
		$item->serial_no = $input['serial_no'];
		$item->item_type_id = $input['item_type_id'];
		$item->client_id = $input['client_id'];
		$item->description = $input['description'];		
		//$client->name = $input['name'];
		$item->save();

		return $item;
	}

	public function search($input)
	{
		return Item::where('serial_no', 'LIKE', '%' . $input . '%')->orderBy('serial_no')->get();
	}

	public function addType($input)
	{

		$type = new ItemType;
		$type->type = $input['type'];

		$type->save();

		return $type;
	}	

	public function updateType($input)
	{
		//dd($input);
		$type = ItemType::find($input['id']);
		$type->type = $input['type'];
		$type->save();

		return $type;
	}	

	public function getAllForClient($clientList)
	{
		return Item::with('client', 'itemType')
						->whereIn('client_id', $clientList)
						->get();

	}	
	
	public function getByIdWithDetailsForClient($clientList)
	{
		return Item::with('client', 'itemType')
						->whereIn('client_id', $clientList)
						->get();

	}	

	public function getSearchResultsForClient($search, $clientList)
	{
		return Item::whereIn('client_id', $clientList)
			->where('serial_no', 'like' , '%'. $search .'%')
			->orderBy('serial_no')
			->get();
	}	
}
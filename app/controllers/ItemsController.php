<?php

use Alpha\Repositories\ItemsRepository;
use Alpha\Repositories\ItemTypesRepository;
use Alpha\Repositories\ClientsRepository;

use Alpha\Forms\ItemForm;
use Alpha\Forms\ItemTypeForm;
use Alpha\Forms\FormValidationException;

use Alpha\Items\RegisterItemCommand;
use Alpha\Items\UpdateItemCommand;
use Alpha\Items\RegisterItemTypeCommand;
use Alpha\Items\UpdateItemTypeCommand;

class ItemsController extends \BaseController {

	protected $itemsRepository;
	protected $itemTypesRepository;
	protected $clientsRepository;

	protected $itemForm;
	protected $itemTypeForm;

	public function __construct(ItemsRepository $itemsRepository, ItemTypesRepository $itemTypesRepository, ClientsRepository $clientsRepository,ItemForm $itemForm, ItemTypeForm $itemTypeForm)
	{
		$this->itemsRepository = $itemsRepository;
		$this->itemTypesRepository = $itemTypesRepository;
		$this->clientsRepository = $clientsRepository;

		$this->itemForm = $itemForm;
		$this->itemTypeForm = $itemTypeForm;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	    $sortby = Input::get('sortby');
	    $order = Input::get('order');
	 
	    if (!$sortby || !$order) {
		    $sortby = 'serial_no';
		    $order = 'asc';
	    }

	    $items = $this->itemsRepository->getAllWithPagination(40);

		return View::make('items/index', compact('items', 'sortby', 'order'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

		$itemTypes = $this->itemTypesRepository->getAllForSelectList();
		$clients = $this->clientsRepository->getAllForSelectList();

		return View::make('items/create', compact('itemTypes', 'clients'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		$this->itemForm->validate(Input::all());

		$item = $this->execute(RegisterItemCommand::class);

		Flash::success("Item ".$item->serial_no." has been registered!");

		return Redirect::route('items.show', $item->id);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		try
		{
			$item = $this->itemsRepository->getByIdWithDetails($id);
			$itemTypes = $this->itemTypesRepository->getAll()->lists('type', 'id');
			return View::make('items/show', compact('item', 'itemTypes'));
		}
		catch (Exception $e)
		{
			Flash::error("Item not found!");
			return Redirect::route('items');
		}
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

		$item = $this->itemsRepository->getById($id);
		$itemTypes = $this->itemTypesRepository->getAllForSelectList();
		$clients = $this->clientsRepository->getAllForSelectList();

		return View::make('items/edit', compact('item', 'itemTypes', 'clients'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{
		$input = Input::all();

		$this->itemForm->validateUpdate($input, $input['id']);

		$item = $this->execute(UpdateItemCommand::class);

		Flash::success("Item ".$item->serial_no." has been updated!");

		return Redirect::route('items.show', $item->id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{

		try
		{
			$i = Item::findOrFail($id);
			$i->delete();

			Flash::success("Item $i->serial_no has been Deleted!");

			return Redirect::route('items');
			//return Redirect::route('clients')->with("message", "Client, $client->name, has been added successfully!");
			//return 'Success!';
		}
		catch (Exception $e)
		{
			Flash::error("Unable to delete Item $i->serial_no.");
			return Redirect::back();
		}		
	}

	public function group($id)
	{

		$item = $this->itemsRepository->getById($id);
		$items = $this->itemsRepository->getAll();
		$itemList = Item::lists('serial_no', 'serial_no');
		//dd($items->toJson());
		return View::make('items/group', compact('items', 'item', 'itemList'));

	}

	public function groupUpdate($id)
	{

		dd(Input::all());

		// $item = $this->itemsRepository->getById($id);
		// $items = $this->itemsRepository->getAll();
		// //dd($reports);
		// return View::make('items/group', compact('items', 'item'));

	}

	public function item_type()
	{
		$itemType = ItemType::orderBy('type')->get();
		return View::make('items/item_type', compact('itemType'));
	}

	public function item_type_create()
	{
		return View::make('items/item_type_create');
	}

	public function post_item_type_create()
	{

		$this->itemTypeForm->validate(Input::all());

		$itemType = $this->execute(RegisterItemTypeCommand::class);

		Flash::success("Item ".$itemType->type." has been registered!");

		return Redirect::route('items.type');

		// $input = Input::all();

		// try
		// {
		// 	$this->itemTypeForm->validate($input);
		// 	$type = $this->itemsRepository->addType($input);

		// 	Flash::success("Item Type, $type->type, has been successfully added!");

		// 	return Redirect::route('item_type');
		// 	//return Redirect::route('clients')->with("message", "Client, $client->name, has been added successfully!");
		// 	//return 'Success!';
		// }
		// catch (FormValidationException $e)
		// {
		// 	return Redirect::back()->withInput()->withErrors($e->getErrors());
		// }

	}	

	public function item_type_edit($id)
	{
		try
		{
			$itemType = ItemType::findOrFail($id);
			return View::make('items/item_type_edit', compact('itemType'));
		}
		catch (Exception $e)
		{
			Flash::error("Type not found!");
			return Redirect::back();
		}	
	}	

	public function item_type_update($id)
	{

		$input = Input::all();

		//dd($input);
		$this->itemTypeForm->validateUpdate($input, $input['id']);

		$itemType = $this->execute(UpdateItemTypeCommand::class);

		Flash::success("Item Type ".$itemType->type." has been updated!");

		return Redirect::route('items.type');

		// $input = Input::all();

		// try
		// {
		// 	$this->itemTypeForm->validate($input);
		// 	$type = $this->itemsRepository->updateType($input);

		// 	Flash::success("Item Type, $type->type, has been successfully UPDATED!");

		// 	return Redirect::route('item_type');
		// 	//return Redirect::route('clients')->with("message", "Client, $client->name, has been added successfully!");
		// 	//return 'Success!';
		// }
		// catch (FormValidationException $e)
		// {
		// 	return Redirect::back()->withInput()->withErrors($e->getErrors());
		// }
	}	

	public function item_type_delete($id)
	{
		$itemType = $this->itemTypesRepository->getById($id);

		if($itemType->items->count() > 0) {

			Flash::error("Item Type $itemType->type is still active and cannot be deleted!");
			return Redirect::back();

		}

		$this->itemTypesRepository->destroy($itemType);

		Flash::success("Item Type $itemType->type has been Deleted!");
		return Redirect::route('items.type');
	}	
}

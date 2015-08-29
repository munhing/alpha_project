<?php namespace Alpha\Repositories;

use ItemType;

class ItemTypesRepository
{

	/**
	 * Get all clients from db
	 *
	 * @return array of Objects
	 */	
	public function getAll()
	{
		return ItemType::orderBy('type')->get();
	}

	public function getById($id)
	{
		return ItemType::with('items')->find($id);
	}

	public function save(ItemType $itemType)
	{
		return $itemType->save();
	}

	public function destroy(ItemType $itemType)
	{
		return $itemType->delete();
	}

	public function getAllForSelectList()
	{
		return ItemType::selectRaw("id, type AS text")->orderBy('text')->get();
	}
}
<?php namespace Alpha\Repositories;

use Location;

class LocationsRepository
{

	/**
	 * Get all clients from db
	 *
	 * @return array of Objects
	 */	
	public function getAll()
	{
		return Location::orderBy('location')->get();
	}

	public function getById($id)
	{
		return Location::with('client')->find($id);
	}

	public function save(Location $location)
	{
		return $location->save();
	}

	public function destroy(Location $location)
	{
		return $location->delete();
	}

	public function getAllForSelectList($client_id)
	{
		return Location::selectRaw("id, location AS text")->where('client_id', $client_id)->orderBy('text')->get();
	}
}
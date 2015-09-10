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

	public function getAllByClient($client_id)
	{
		return Location::where('client_id', $client_id)->orderBy('location')->get();
	}

	public function getById($id)
	{
		// return Location::with('client', 'reports', 'certificates', 'items')->find($id);
        
        return Location::with([
                'client', 
                'reports' => function($query){
                    $query->selectRaw("reports.*, (`next_inspection`) > (NOW())  AS `status`");
                }, 
                'certificates' => function($query){
                    $query->selectRaw("certificates.*, (`next_inspection`) > (NOW())  AS `status`");
                },  
                'items'])
            ->find($id);
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

	public function getAllForClient($clientList)
	{
		return Location::whereIn('client_id', $clientList)
						->orderBy('location')
						->get();
	}	
}
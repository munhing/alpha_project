<?php namespace Alpha\Repositories;

use User;
use Client;

class UsersRepository
{

	/**
	 * Get all clients from db
	 *
	 * @return array of Objects
	 */	
	public function getAll()
	{
		return User::all();
	}

	public function getById($id)
	{
		return User::with('clients')->find($id);
	}

	public function addClients($id, $clients)
	{
		//dd($items);
		$listedClients = User::find($id)->clients()->select('clients.*')->lists('name', 'id');

		//dd($listedItems);

		if($clients) {
			foreach ($clients as $client) {

				if (!array_key_exists($client, $listedClients)) {

					$c = Client::find($client);
					$c->users()->attach($id);

				}
			}
		}
		//return Report::where('report_no', 'LIKE', '%' . $input . '%')->orderBy('report_no')->get();
	}

	public function removeClient($id, $user_id)
	{
		$u = User::find($user_id);
		//dd($c->toArray());
		$u->clients()->detach($id);
	}	
}
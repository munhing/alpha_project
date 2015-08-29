<?php namespace Alpha\Repositories;

use Client;

class ClientsRepository
{

	/**
	 * Get all clients from db
	 *
	 * @return array of Objects
	 */	
	public function getAll()
	{
		return Client::all();
	}

	public function getAllWithPagination($row = 20)
	{
		return Client::with('reports', 'certificates', 'items')->orderBy('name')->paginate($row);
	}

	public function getAllForSelectList()
	{
		return Client::selectRaw("id, name AS text")->orderBy('text')->get();
	}

	public function getById($id)
	{
		return Client::find($id);
	}

	public function save(Client $client)
	{
		return $client->save();
	}

	public function getAllReports($id)
	{
		return Client::with([
					'reports' => function($query){
						$query->orderBy('report_no', 'asc');
					}
				])->find($id);
	}

	public function getAllCertificates($id)
	{
		return Client::with([
					'certificates' => function($query){
						$query->orderBy('cert_no', 'asc');
					}
				])->find($id);
	}

	public function getAllItems($id)
	{
		return Client::with([
				'items' => function($query){
					$query->selectRaw('items.*, item_type.type')->join('item_type', 'items.item_type_id', '=', 'item_type.id')->orderBy('type', 'asc')->orderBy('serial_no', 'asc');
				}
			])->find($id);
	}

	public function search($input)
	{
		return Client::where('name', 'LIKE', '%' . $input . '%')->orderBy('name')->get();
	}

}